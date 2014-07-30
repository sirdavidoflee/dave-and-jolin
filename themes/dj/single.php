<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $metaDesc = get_the_excerpt();
	?>
<?php endwhile; endif; ?>
<?
/*
Template Name: Peaceful Powerful You
*/
//$metaDesc = "Dave and Jolin's awesome site, yo";
include(TEMPLATEPATH."/header.php");
?>

	<?php $cat = get_top_category(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php  ?>
		
		<?php
		$filename = TEMPLATEPATH . '/post_types/post-' . $cat . '.php';

		if (file_exists($filename)) { 
		    include($filename);
		} else {
			include(TEMPLATEPATH . '/post_types/post-default.php');
		}
		?>
		
	<?php endwhile; endif; ?>
	
<?php get_footer(); ?>