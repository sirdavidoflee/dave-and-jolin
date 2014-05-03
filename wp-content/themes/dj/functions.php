<?php

// Let's get rid of the p tags around these excerpts
//remove_filter('the_excerpt', 'wpautop');

// Add 2.9 thumbnail support
add_theme_support('post-thumbnails');

// Includes
include("_inc/sidebars.php");
include("_inc/widgets.php");
include("_inc/ajax.php");
include("_inc/template.php");
include("_inc/shortcodes.php");



/**
 * general function that reads top category from url
 * TODO: Find a more wordpressy way to do this
 *
 * @param string $index 
 * @return string
 * @author Mark Robert Henderson
 */
function get_top_category($index=1, $url = NULL) {
	global $post;
    	if(empty($url)) $url = $_SERVER['REQUEST_URI'];
  
	$url_array = explode("/", $url);

	$category = isset($url_array[2]) 
		? $url_array[$index]
		: null;

	if (empty($category) && $index == 1 && $url != '/') {
		$categories = get_the_category($post->ID);
		$cat = ($categories[0]->parent != 0)
			? get_term($categories[0]->category_parent, 'category')
			: $categories[0];;
	
		$category = $cat->name;
	} 
    
	if (empty($category))
		return false;

	return $category;
}

function current_nav($current) {
	global $post;
    $url = $_SERVER['REQUEST_URI'];
	$url_array = explode("/", $url);
	$category = isset($url_array[2]) 
		? $url_array[$index]
		: null;
	
	if($url_array[1]==$current){
		echo 'class="current"';
	}
}


function default_thumbnail_slides(){
	if (has_post_thumbnail()){
		the_post_thumbnail();
	}
	else {
		//$rand = rand(1, 4);
		//echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default-thumbnail-'.$rand.'.gif" alt="title" title="title" />';
	}
		
}

function cat_url($level, $pid = false){
	$topCat = get_top_category();
	$args = array('orderby' => 'none');
	$terms = wp_get_post_terms($pid, 'category', $args);
	//print_r($terms);
	
	$cat = get_the_category();
	
	$cat_one = $cat[$level]->slug;
	if($level != 0){
		$cat_one =  $cat[0]->slug;
		$cat_two = $cat[$level]->slug;
		echo '<a href="/' . $topCat . '/' . $terms[$level]->slug . '">' . $terms[$level]->name . '</a>';
	}
	else {
		echo '<a href="/' . $terms[$level]->slug . '">' . $terms[$level]->name . '</a>';
	}
	
}

function cat_detail_url($level, $pid = false){
	$topCat = get_top_category();
	$args = array('orderby' => 'none');
	$terms = wp_get_post_terms($pid, 'category', $args);
	//print_r($terms);
	
	$cat = get_the_category();
	
	$cat_one = $cat[$level]->slug;
	if($level != 0){
		$cat_one =  $cat[0]->slug;
		$cat_two = $cat[$level]->slug;
		echo $terms[$level]->name;
	}
	else {
		echo $terms[$level]->name;
	}
	
}


function default_thumbnail(){
	if (has_post_thumbnail()){
		echo '<a class="img" href="'. get_permalink() .'">';
		the_post_thumbnail('thumbnail');
		echo '</a>';
	}
	else {
		// $cat = get_the_category();
		// echo '<a class="img" href="'. get_permalink() .'">';
		// echo '<img src="/wp-content/img/icons/small-' . $cat[1]->slug . '.jpg" />';
		// echo '</a>';
	}
		
}

function postnail(){
	if (has_post_thumbnail()){
		echo '<span class="img">';
		the_post_thumbnail('thumbnail');
		echo '</span>';
	}
}

function talent_thumbnail(){
	if (has_post_thumbnail()){
		echo '<a class="img" href="'. get_permalink() .'">';
		the_post_thumbnail('thumbnail');
		echo '</a>';
	}
	else {
		$rand = rand(1, 4);
		echo '<a class="img" href="'. get_permalink() .'">';
		echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default-thumbnail-'.$rand.'.gif" alt="title" title="title" class="no-img" />';
		echo '</a>';
	}
		
}


function default_thumbnail_large(){
	if (has_post_thumbnail()){
		the_post_thumbnail();
	}
	else {
		//$rand = rand(1, 4);
		//echo '<img src="' . get_bloginfo('stylesheet_directory') . '/img/default-thumbnail-'.$rand.'.gif" alt="title" title="title" />';
	}
		
}

function search_thumbnail(){
	if (has_post_thumbnail()){
		echo '<span class="img">';
		the_post_thumbnail('medium');
		echo '</span>';
	}
	else {
		//$rand = rand(1, 4);
		//echo '<span class="img"><img src="' . get_bloginfo('stylesheet_directory') . '/img/default-thumbnail-'.$rand.'.gif" alt="title" title="title" class="no-img" /></span>';
	}
		
}

function meta_set($metaName){

	global $post;
	if(get_post_meta($post->ID, $metaName, true)){
		echo '| <em>' . $metaName . ':</em> <span>'. get_post_meta($post->ID, $metaName, true) . '</span>';
	}
	else{
		
	}
}

function meta_set_link($metaName){

	global $post;
	if(get_post_meta($post->ID, $metaName, true)){
		echo '| <em>' . $metaName . ':</em> <a href="' . get_post_meta($post->ID, $metaName, true) . '" target="_blank">'. get_post_meta($post->ID, $metaName, true) . '</a>';
	}
	else{
		
	}
}

function meta_set_first($metaName){

	global $post;
	if(get_post_meta($post->ID, $metaName, true)){
		echo '<em>' . $metaName . ':</em> <span>'. get_post_meta($post->ID, $metaName, true) . '</span>';
	}
	else{
		
	}
}



/**
 * I forgot where I got this from or what it does but it has something
 * to do with pretty URLs / Permalinks
 *
 * @param string $string 
 * @param string $type 
 * @return string
 * @author Mark Robert Henderson
 */
function fix_slash( $string, $type )
{
    global $wp_rewrite;
    if ( $wp_rewrite->use_trailing_slashes == false )
    {
        if ( $type != 'single' && $type != 'category' )
            return trailingslashit( $string );
 
        if ( $type == 'single' && ( strpos( $string, '.html/' ) !== false ) )
            return trailingslashit( $string );
 
        if ( $type == 'category' && ( strpos( $string, 'category' ) !== false ) )
        {
            $aa_g = str_replace( "/category/", "/", $string );
            return trailingslashit( $aa_g );
        }
        if ( $type == 'category' )
            return trailingslashit( $string );
    }
    return $string;
}
add_filter( 'user_trailingslashit', 'fix_slash', 55, 2 );

/**
 * Simple myTruncate Function that works
 * Original PHP code by Chirp Internet: www.chirp.com.au 
 * Please acknowledge use of this code by including this header. 
 *
 * @param string $string 
 * @param string $limit 
 * @param string $break 
 * @param string $pad 
 * @return void
 * @author Mark Robert Henderson
 */ 
function myTruncate($string, $limit, $break=".", $pad="...") {
    // return with no change if string is shorter than $limit  
    if(strlen($string) <= $limit) return $string; 

    // is $break present between $limit and the end of the string?  
    if(false !== ($breakpoint = strpos($string, $break, $limit))) { 
	    if($breakpoint < strlen($string) - 1) { 
		    $string = substr($string, 0, $breakpoint) . $pad; 
	    } 
    } 

    return $string; 
}

add_filter('excerpt_length', 'my_excerpt_length');
function my_excerpt_length($length) {
return 400; }

if(!function_exists('get_latest_tweet')):
function get_latest_tweet($user="irrationalgames") {
	require_once(ABSPATH . 'wp-includes/class-snoopy.php');
	$tweet   = get_option("lasttweet");
	$url  = "http://twitter.com/statuses/user_timeline/" .$user. ".json?count=20";
	if ($tweet['lastcheck'] < ( mktime() - 60 ) ) {
	  $snoopy = new Snoopy;
	  $result = $snoopy->fetch($url);
	  if ($result) {
	    $twitterdata   = json_decode($snoopy->results,true);
	    $i = 0;
	    while ($twitterdata[$i]['in_reply_to_user_id'] != '') {
	      $i++;
	    }
	    $pattern  = '/\@([a-zA-Z0-9-\_]+)/';
	    $replace  = '<a href="http://twitter.com/'.strtolower('\1').'">@\1</a>';
	    $output   = preg_replace($pattern,$replace,$twitterdata[$i]["text"]);  
	 	$output = make_clickable($output);
	 	
	    $tweet['lastcheck'] = mktime();
	    $tweet['data']    = $output;
	    $tweet['rawdata']  = $twitterdata;
	    $tweet['followers'] = $twitterdata[0]['user']['followers_count'];
	    update_option('lasttweet',$tweet);
	  } else {
	    echo "Twitter API not responding.";
	  }
	} else {
	  $output = $tweet['data'];
	}
	echo "<p>\"".$output."\"</p>";
}
endif;


function improved_trim_excerpt($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]&gt;', $text);
		$text = str_replace('<li>', '', $text);
		$text = str_replace('</li>', '', $text);
		$text = str_replace('<ul>', '', $text);
		$text = str_replace('</ul>', '', $text);
		$text = str_replace('<ol>', '', $text);
		$text = str_replace('</ol>', '', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		//$text = strip_tags($text, '<p>');
		//$text = strip_tags($text, '<li>');
		//$text = strip_tags($text, '<ul>');
		$excerpt_length = 80;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '...');
			$text = implode(' ', $words);
		}
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt');
