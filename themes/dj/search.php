<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

global $wp_query;

//get_header(); ?>
<?php $metaDesc = "A site filled with some of the most important knowledge ever. Drawings, Food, Pictures of awesomeness etc."; ?>
<? include(TEMPLATEPATH."/header.php"); ?>

	<div class="heart">
		
		<div class="post-list">

		<?php if (have_posts()) : ?>

			<?php $total_results = $wp_query->found_posts; ?>
			<h1><?php echo $total_results;?> results for &#8216;<?php the_search_query(); ?>&#8217;</h1>
		

			<!-- <div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div> -->

			<ul class="clearfix">
				<?php while (have_posts()) : the_post(); ?>
					<?php 
						$cat = get_the_category(); 
						if($cat[0]->slug != 'home-slideshow'): ?>
					
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
						<p><?php the_excerpt(); ?></p>
						<a href="<?php the_permalink() ?>">see this post in all its glory &raquo;</a>

					</li>
					
					<?php endif; ?>

				<?php endwhile; ?>


			<?php else : ?>

				<h2 class="center">No posts found. Try harder.</h2>

			<?php endif; ?>

		</div>
		<?php if (have_posts()) : ?>
			<?php if($wp_query->max_num_pages!=1):?>
			<div class="pagination">
				<?php previous_posts_link('&laquo; prev') ?>
				<span class="current"><?php if($wp_query->query['paged']==''){ echo '1';}else{ echo $wp_query->query['paged']; } ?></span>
				of <span class="total"><?php echo $wp_query->max_num_pages; ?></span>
				<?php next_posts_link('next &raquo;') ?>
			</div><!-- .pagination -->
			<?php endif; ?>
		<?php endif;?>
	</div>

	<ul class="lungs">
		<?php dynamic_sidebar("Search Page"); ?>
	</ul><!-- #callouts -->

<?php get_footer(); ?>
