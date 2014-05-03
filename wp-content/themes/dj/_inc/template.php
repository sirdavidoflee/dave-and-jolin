<?php

/**
 * Template Functions for Tufts Keeping You Healthy Theme
 *
 * @author Mark Robert Henderson
 */


/**
 * kyh_home_class
 * Template function for home and events page
 *
 * @package template
 * @author Mark Robert Henderson
 */
function kyh_home_class() {
	if(is_home()) {
		$class = 'class="home fancy"';
	} elseif(get_top_category() == "events") {
		$class = 'class="fancy"';
	} else {
		$class = "";
	}
	
	echo $class;
}

/**
 * on class for nav bar "on" state
 *
 * @package template
 * @author Mark Robert Henderson
 */
function on_class($url) {	
	$class = '';
	if($url == get_top_category()) { 
		$class = 'class="on"';
	}
	if(get_top_category() == '' && $url=='home') { 
		$class = 'class="on"';
	}
	
	echo $class;
}

function on_sub_class($url) {	
	$class = '';
	if($url == get_top_category(2)) { 
		$class = 'class="on"';
	}
	
	echo $class;
}

/**
 * Special display case for "/tips" url
 *
 * @package tempate
 * @author Mark Robert Henderson
 */
function content_class() { 
	$class = 'class="profile-view clearfix"';
	if(get_top_category() == "tips") { 
		$class = 'class="tips clearfix"';
	}
	
	echo $class;
}

/**
 * Returns Modals for specific pages based on URL
 * TODO: Move to footer.php?
 *
 * @return void
 * @author Mark Robert Henderson
 */
function get_modals() {
	if(get_top_category() == "coupons") {
		include(TEMPLATEPATH . "/modals/modals-coupons.php");
	} elseif(get_top_category() == "tips") {
		include(TEMPLATEPATH . "/modals/modals-tips.php");
	} elseif(get_top_category(2)) {
		include(TEMPLATEPATH . "/modals/modals-article-detail.php");
		include(TEMPLATEPATH . "/modals/modals-comments.php");
	} elseif(get_top_category() == "events") {
		include(TEMPLATEPATH . "/modals/modals-newsletter.php");
		include(TEMPLATEPATH . "/modals/modals-events.php");
	} 
}

/**
 * Comment Display Override
 *
 * @param string $comment 
 * @param string $args 
 * @param string $depth 
 * @return unknown
 * @author Mark Robert Henderson
 */
function mrh_comments($comment, $args, $depth) { 
    $GLOBALS['comment'] = $comment; 
    if($comment->comment_approved == 1): ?>
    <li>
		<dl>
			<dt class="date"><?php comment_time("F j, Y"); ?> <strong><?php comment_author(); ?></strong> said</dt>
			<dd>
				<?php comment_text() ?>
			</dd>
		</dl>
<?php endif;
}

/**
 * Filter function for "prev" pagination button
 *
 * @param string $attr 
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_previous_posts_link_attributes($attr) {
    return 'class="btn2 prev"';
}
add_filter("previous_posts_link_attributes", "mrh_previous_posts_link_attributes");

/**
 * Fulter function for "next" pagination button
 *
 * @param string $attr 
 * @return void
 * @author Mark Robert Henderson
 */
function mrh_next_posts_link_attributes($attr) {
    return 'class="btn2 next"';
}
add_filter("next_posts_link_attributes", "mrh_next_posts_link_attributes");

/**
 * Gets a post image - added support for $index="rand"
 *
 * @param string $type 
 * @param string $index 
 * @param string $id 
 * @param string $echo 
 * @return void
 * @author Mark Robert Henderson
 */
function get_post_image($type="thumbnail", $index=0, $id=null, $echo=true){
	global $post;
	if($id == null) $id = $post->ID;
	
	$images = get_posts(array(
	   'post_type' => 'attachment',
	   'post_status' => null,
	   'post_parent' => $id,
	   'post_mime_type' => 'image',
	   'order' => 'ASC',
	   'orderby' => 'menu_order ID'));
	
	$return = array();
	if($images):
	   foreach($images as $image):
	   	 $image = wp_get_attachment_image_src($image->ID, $type);
	   	 $return[] = $image;
	   endforeach;
	endif;
	
	if($echo) 
		if($index == "rand") {
		    $rand_index = array_rand($return);
		    echo $return[$rand_index][0];
		} else {
		    echo $return[$index][0];
		}
	return $return[$index][0];
}