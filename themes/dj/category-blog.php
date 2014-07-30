<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

$stickyEvents = new WP_Query();
$stickyEvents->query(array('category_name' => "home-slideshow",
                         'post__in' => $sticky));

get_header(); ?>

	<div class="heart">

	<?php if (have_posts()) : ?>
		
		<div class="post-list">
		
			<h1>The Feed</h1>
		
			<ul>
			<?php while (have_posts()) : the_post(); ?>
				
    		    <?php 
					$cat = get_the_category(); 
					if($cat[0]->slug != 'home-slideshow'): ?>
			
				<li>
					<?php default_thumbnail(); ?>
					<h3>
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a> 
						<span class="date"><?php the_time('j M, Y') ?></span>
					</h3>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink() ?>">read on &raquo;</a> 
					
				</li>
				
				<?php endif;?>

			<?php endwhile; ?>

			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
		
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>
		<div class="pagination">
			<a href="<?php bloginfo('url'); ?>/about">&laquo; back to about</a>
		</div><!-- .pagination -->
	</div>

<ul class="lungs">
	<?php dynamic_sidebar("Blog Page"); ?>
</ul><!-- #callouts -->

<?php get_footer(); ?>
