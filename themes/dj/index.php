<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

//$stickySlides = new WP_Query();
//$stickySlides->query(array('category_name' => "home-slideshow"));

$blogPosts = new WP_Query();
//$homePosts = get_category_by_slug('dave')->term_id . ',' . get_category_by_slug('jolin')->term_id . ',' . get_category_by_slug('joint')->term_id . ',' . get_category_by_slug('videos')->term_id;
$blogPosts->query(array('showposts'=>20));
?>

<?php $metaDesc = "A site filled with some of the most important knowledge ever. Drawings, Food, Pictures of awesomeness etc."; ?>
<? include(TEMPLATEPATH."/header.php"); ?>

	<div class="heart">

	<?php if($blogPosts->have_posts()): ?>
		
		<div class="post-list">
		
			<h1>Recent Awesomeness</h1>
		
			<ul>
			<?php while (have_posts()) : the_post(); ?>
				<li>
					<?php default_thumbnail(); ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<h5>Posted in: <?php cat_url(0, $post->ID); ?> on <?php the_time("F j, Y"); ?></h5>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink() ?>">see this post in all its glory &raquo;</a>
					
				</li>
			<?php endwhile; ?>

			<?php if($blogPosts->max_num_pages!=1):?>
			<div class="pagination">

				<?php previous_posts_link('&laquo; Previous') ?>
				<span class="current"><?php if($blogPosts->query['paged']==''){ echo '1';}else{ echo $blogPosts->query['paged']; } ?></span>
				of, or around <span class="total"><?php echo $blogPosts->max_num_pages; ?></span>
				<?php next_posts_link('Next &raquo;') ?>
			</div><!-- .pagination -->
			<?php endif; ?>
		
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<ul class="lungs">
	<?php dynamic_sidebar("Home Page"); ?>
</ul><!-- #callouts -->

<?php get_footer(); ?>
