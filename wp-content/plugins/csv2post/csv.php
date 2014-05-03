<?php
/*
Class Name: CSV_Import
Description: Import posts from a CSV file including extra (custom) fields
Version: 0.001
Author: Zack Preble
Author URI: http://www.zackpreble.com
*/


/*  
	Copyright 2008  Zack Preble  (email : zaca1000@hotmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

class CSV_Import {

	var $posts = array ();
	var $posts_processed = array ();
    // Array of arrays. [[0] => XML fragment, [1] => New post ID]
	var $file;
	var $id;
	var $mtnames = array ();
	var $newauthornames = array ();
	var $j = -1;
	var $header_row = array();

	function header() {
		echo '<div class="wrap">';
		echo '<h2>'.__('Import CSV').'</h2>';
	}

	function footer() {
		echo '</div>';
	}

	function unhtmlentities($string) { // From php.net for < 4.3 compat
		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		return strtr($string, $trans_tbl);
	}

	function greet() {
		echo '<div class="narrow">';
		echo '<p>'.__('Howdy! Upload your CSV file (pipe-delimited) and we&#8217;ll import the <b>posts and custom fields only</b> into this blog.').'</p>';
		echo '<p>Must obey this format (header row) wp_title | wp_post_date | wp_category | wp_content | key_name | key_name ...<br /> The first five fields must be named like above, the key_name fields should be the name of each specific custom field.';
		echo '<p>All other fields will have default values selected for you (sorry, this is a beta)</p>';
		echo '<p>'.__('Choose a CSV file to upload, then click Upload file and import.').'</p>';
		wp_import_upload_form("admin.php?import=csv&amp;step=1");
		echo '</div>';
	}

	function get_field_value( $string, $tag ) {
	
		$post_row = explode("|",$string);
		$key = array_search($tag, $this->header_row); // $key = 2;
		return $post_row[$key];
	}


	function get_tag( $string, $tag ) {
	
		global $wpdb;
		preg_match("|<$tag.*?>(.*?)</$tag>|is", $string, $return);
		$return = preg_replace('|^<!\[CDATA\[(.*)\]\]>$|s', '$1', $return[1]);
		$return = $wpdb->escape( trim( $return ) );
		return $return;
	}

	function users_form($n) {
		global $wpdb, $testing;
		$users = $wpdb->get_results("SELECT * FROM $wpdb->users ORDER BY ID");
?><select name="userselect[<?php echo $n; ?>]">
	<option value="#NONE#">- Select -</option>
	<?php
		foreach ($users as $user) {
			echo '<option value="'.$user->user_login.'">'.$user->user_login.'</option>';
		}
?>
	</select>
	<?php
	}

	//function to check the authorname and do the mapping
	function checkauthor($author) {
		global $wpdb;
		//mtnames is an array with the names in the mt import file
		$pass = 'changeme';
		if (!(in_array($author, $this->mtnames))) { //a new mt author name is found
			++ $this->j;
			$this->mtnames[$this->j] = $author; //add that new mt author name to an array
			$user_id = username_exists($this->newauthornames[$this->j]); //check if the new author name defined by the user is a pre-existing wp user
			if (!$user_id) { //banging my head against the desk now.
				if ($this->newauthornames[$this->j] == 'left_blank') { //check if the user does not want to change the authorname
					$user_id = wp_create_user($author, $pass);
					$this->newauthornames[$this->j] = $author; //now we have a name, in the place of left_blank.
				} else {
					$user_id = wp_create_user($this->newauthornames[$this->j], $pass);
				}
			} else {
				return $user_id; // return pre-existing wp username if it exists
			}
		} else {
			$key = array_search($author, $this->mtnames); //find the array key for $author in the $mtnames array
			$user_id = username_exists($this->newauthornames[$key]); //use that key to get the value of the author's name from $newauthornames
		}

		return $user_id;
	}

	function get_entries() {
		set_magic_quotes_runtime(0);
		$importdata = array_map('rtrim', file($this->file)); // Read the file into an array

		$this->posts = array();
		$this->categories = array();
		$num = 0;
		$doing_entry = false;
		foreach ($importdata as $importline) {
			// Get header row
			if ( $num == 0 )
			{
				$this->header_row = explode("|",$importline);	
			}
			else
			{
				$this->posts[$num] = $importline . "\n";
			}
			$num++;
		}
	}

	function get_wp_authors() {
		$temp = array ();
		$i = -1;
		foreach ($this->posts as $post) {
			if ('' != trim($post)) {
				++ $i;
				$author = $this->get_tag( $post, 'dc:creator' );
				array_push($temp, "$author"); //store the extracted author names in a temporary array
			}
		}

		// We need to find unique values of author names, while preserving the order, so this function emulates the unique_value(); php function, without the sorting.
		$authors[0] = array_shift($temp);
		$y = count($temp) + 1;
		for ($x = 1; $x < $y; $x ++) {
			$next = array_shift($temp);
			if (!(in_array($next, $authors)))
				array_push($authors, "$next");
		}

		return $authors;
	}

	function get_authors_from_post() {
		$formnames = array ();
		$selectnames = array ();

		foreach ($_POST['user'] as $key => $line) {
			$newname = trim(stripslashes($line));
			if ($newname == '')
				$newname = 'left_blank'; //passing author names from step 1 to step 2 is accomplished by using POST. left_blank denotes an empty entry in the form.
			array_push($formnames, "$newname");
		} // $formnames is the array with the form entered names

		foreach ($_POST['userselect'] as $user => $key) {
			$selected = trim(stripslashes($key));
			array_push($selectnames, "$selected");
		}

		$count = count($formnames);
		for ($i = 0; $i < $count; $i ++) {
			if ($selectnames[$i] != '#NONE#') { //if no name was selected from the select menu, use the name entered in the form
				array_push($this->newauthornames, "$selectnames[$i]");
			} else {
				array_push($this->newauthornames, "$formnames[$i]");
			}
		}
	}

	function csv_authors_form() {
?>
<h2><?php _e('Assign Authors'); ?></h2>
<p><?php _e('To make it easier for you to edit and save the imported posts and drafts, you may want to change the name of the author of the posts. For example, you may want to import all the entries as <code>admin</code>s entries.'); ?></p>
<p><?php _e('If a new user is created by WordPress, the password will be set, by default, to "changeme". Quite suggestive, eh? ;)'); ?></p>
	<?php


		$authors = $this->get_wp_authors();
		echo '<ol id="authors">';
		echo '<form action="?import=csv&amp;step=2&amp;id=' . $this->id . '" method="post">';
		wp_nonce_field('import-csv');
		$j = -1;
		foreach ($authors as $author) {
			++ $j;
			echo '<li>'.__('Current author:').' <strong>'.$author.'</strong><br />'.sprintf(__('Create user %1$s or map to existing'), ' <input type="text" value="'.$author.'" name="'.'user[]'.'" maxlength="30"> <br />');
			$this->users_form($j);
			echo '</li>';
		}

		echo '<input type="submit" value="Submit">'.'<br/>';
		echo '</form>';
		echo '</ol>';

	}

	function select_authors() {
		$file = wp_import_handle_upload();
		if ( isset($file['error']) ) {
			echo '<p>'.__('Sorry, there has been an error.').'</p>';
			echo '<p><strong>' . $file['error'] . '</strong></p>';
			return;
		}
		$this->file = $file['file'];
		$this->id = (int) $file['id'];

		$this->get_entries();
		$this->csv_authors_form();
	}

	function process_categories() {
		global $wpdb;

		$cat_names = (array) $wpdb->get_col("SELECT cat_name FROM $wpdb->categories");

		while ( $c = array_shift($this->categories) ) {
			$cat_name = trim($this->get_field_value( $c, 'wp_category' ));

			// If the category exists we leave it alone
			if ( in_array($cat_name, $cat_names) )
				continue;

			$category_nicename	= sanitize_title_with_dashes($cat_name);
			
			$posts_private		= '0';
			$links_private		= '0';
			$category_parent = '0';

			$catarr = compact('category_nicename', 'category_parent', 'posts_private', 'links_private', 'posts_private', 'cat_name');

			$cat_ID = wp_insert_category($catarr);
		}
	}

	function process_posts() {
		$i = -1;
		echo '<ol>';

		foreach ($this->posts as $post)
			$this->process_post($post);

		echo '</ol>';

		wp_import_cleanup($this->id);

		echo '<h3>'.sprintf(__('All done.').' <a href="%s">'.__('Have fun!').'</a>', get_option('home')).'</h3>';
	}
  
	function process_post($post) {
		global $wpdb;
	
		$post_ID = (int) $this->get_tag( $post, 'wp:post_id' );
  		if ( $post_ID && !empty($this->posts_processed[$post_ID][1]) ) // Processed already
			return 0;
      
	   //wp_title|wp_post_date|wp_category|wp_content|cylinders|cooling
		// There are only ever one of these
		$post_title     = $this->get_field_value( $post, 'wp_title' );
		
		$post_date      = $this->get_field_value( $post, 'wp_post_date' );
		$post_date_gmt  = $post_date;
		$comment_status = "open";
		$ping_status    = "open";
		$post_status    = "publish";
		$post_name      = sanitize_title_with_dashes($post_title);
		$post_parent    = "0";
		$menu_order     = "0";
		$post_type      = "post";
		$category_name = $this->get_field_value( $post, 'wp_category' );
		$guid           = "" ;

		$post_author    = "1";

		$post_content = $this->get_field_value( $post, 'wp_content' );
		$post_content = preg_replace('|<(/?[A-Z]+)|e', "'<' . strtolower('$1')", $post_content);
		$post_content = str_replace('<br>', '<br />', $post_content);
		$post_content = str_replace('<hr>', '<hr />', $post_content);

		$categories[] = $this->get_field_value( $post, 'wp_category' );

		if ($post_id = post_exists($post_title, '', $post_date)) {
			echo '<li>';
			printf(__('Post <i>%s</i> already exists.'), stripslashes($post_title));
		} else {

			// If it has parent, process parent first.
			$post_parent = (int) $post_parent;
			if ($parent = $this->posts_processed[$post_parent]) {
				if (!$parent[1]) $this->process_post($parent[0]); // If not yet, process the parent first.
				$post_parent = $parent[1]; // New ID of the parent;
			}

			echo '<li>';
			printf(__('Importing post <i>%s</i>...'), stripslashes($post_title));

			$post_author = $this->checkauthor($post_author); //just so that if a post already exists, new users are not created by checkauthor

			$postdata = compact('post_author', 'post_date', 'post_date_gmt', 'post_content', 'post_title', 'post_excerpt', 'post_status', 'post_name', 'comment_status', 'ping_status', 'post_modified', 'post_modified_gmt', 'guid', 'post_parent', 'menu_order', 'post_type');
			$post_id = wp_insert_post($postdata);

			// Memorize old and new ID.
			if ( $post_id && $post_ID && $this->posts_processed[$post_ID] )
				$this->posts_processed[$post_ID][1] = $post_id; // New ID.
			
			// Add categories.
			if (count($categories) > 0) {
				$post_cats = array();
				foreach ($categories as $category) {
				
					$cat_ID = (int) $wpdb->get_var("SELECT cat_ID FROM $wpdb->categories WHERE cat_name = '$category'");
					if ($cat_ID == 0) {
						$cat_ID = wp_insert_category(array('cat_name' => $category));
					}
					$post_cats[] = $cat_ID;
				}
				wp_set_post_categories($post_id, $post_cats);
			}	
		}

		// Now for post meta
		$number_of_fields = count($this->header_row);
		for($counter = 4;  $counter < $number_of_fields ; $counter++)
		{
			$key   = $this->header_row[$counter];
			$value = $this->get_field_value( $post, $key );
			$value = stripslashes($value); // add_post_meta() will escape.
			if($value !="" )
			{
				add_post_meta( $post_id, $key, $value );
			}
		
		}


	}

	function import() {
		$this->id = (int) $_GET['id'];
		$this->file = get_attached_file($this->id);
		$this->get_authors_from_post();
		$this->get_entries();
		$this->process_categories();
		$this->process_posts();
	}

	function dispatch() {
		if (empty ($_GET['step']))
			$step = 0;
		else
			$step = (int) $_GET['step'];

		$this->header();
		switch ($step) {
			case 0 :
				$this->greet();
				break;
			case 1 :
				check_admin_referer('import-upload');
				$this->select_authors();
				break;
			case 2:
				check_admin_referer('import-csv');
				$this->import();
				break;
		}
		$this->footer();
	}

	function CSV_Import() {
		// Nothing.
	}
}

$csv_import = new CSV_Import();

register_importer('csv', 'CSV', __('Import <strong>posts and custom fields</strong> from a (pipe-delimited) csv file by <a href="http://www.zackpreble.com">Zack Preble</a>'), array ($csv_import, 'dispatch'));

?>