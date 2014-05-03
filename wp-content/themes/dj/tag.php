<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//get_header();
?>
<?php $metaDesc = "A site filled with some of the most important knowledge ever. Drawings, Food, Pictures of awesomeness etc."; ?>
<? include(TEMPLATEPATH."/header.php"); ?>

	<div class="heart">
			<?php if (have_posts()) : ?>

				<?php 
					$cat = get_the_category();
					
					if($cat[2]){
						$catSlug = $cat[2]->slug;
					}
					elseif($cat[3]){
						$catSlug = $cat[2]->slug;
					}
					else{
						$catSlug = $cat[1]->slug;
					}
				?>
				<!--<?php print_r($cat); ?>-->

				<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
								
		<div class="post-list">

			<ul class="clearfix">

			<?php while (have_posts()) : the_post(); ?>

					<!-- <li>
						<a href="<?php the_permalink() ?>">
							<?php search_thumbnail(); ?>
							<?php echo myTruncate(get_the_title(), 10, " "); ?>
						</a>
						<p><?php echo myTruncate(get_the_excerpt(), 45, " "); ?> <?php edit_post_link('Edit'); ?></p>
					</li> -->
					
					<li>
						<?php default_thumbnail(); ?>
						<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<p><?php echo myTruncate(get_the_content(), 400, " "); ?></p>
						<a href="<?php the_permalink() ?>">see this post in all its glory &raquo;</a>

					</li>

			<?php endwhile; ?>
			
			</ul>
		</div>

		<?php else :

			if ( is_category() ) { // If this is a category archive
				printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
			} else {
				echo("<h2 class='center'>No posts found.</h2>");
			}
			get_search_form();

		endif;
	?>
		
		<?php if($wp_query->max_num_pages!=1):?>
		<div class="pagination">
			<?php previous_posts_link('&laquo; prev') ?>
			<span class="current"><?php if($wp_query->query['paged']==''){ echo '1';}else{ echo $wp_query->query['paged']; } ?></span>
			of <span class="total"><?php echo $wp_query->max_num_pages; ?></span>
			<?php next_posts_link('next &raquo;') ?>
		</div><!-- .pagination -->
		<?php endif; ?>
	</div>

	<ul class="lungs">
		<?php dynamic_sidebar("Search Page"); ?>
	</ul><!-- #callouts -->

<?php get_footer(); ?>
