<?php $metaDesc = "All the things that Jolin does, Outings, Foodsies, Fun Nails, etc!"; ?>
<? include(TEMPLATEPATH."/header.php"); ?>

<?php $article_categories = get_categories(array(
                                    'child_of' => get_category_by_slug('jolin')->term_id
                            )); ?>
	

	<div class="heart">

		<h1>Jolin's list of things she does</h1>

	<?php if (have_posts()) : ?>
		
		<div class="post-list">
		
			<ul class="clearfix">

			<?php while (have_posts()) : the_post(); ?>
				
				<!-- <li>
					<a href="<?php the_permalink() ?>">
						<?php default_thumbnail(); ?>
						<?php echo myTruncate(get_the_title(), 15, " "); ?>
					</a>
					<p><?php echo myTruncate(get_the_excerpt(), 45, " "); ?></p>
				</li> -->
				
				<li>
					<?php default_thumbnail(); ?>
					<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
					<h5>Posted in: <?php cat_url(1, $post->ID); ?> on <?php the_time("F j, Y"); ?></h5>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink() ?>">see this post in all its glory &raquo;</a>
					
				</li>

			<?php endwhile; ?>
		
		
		</div>
		
		<?php if($wp_query->max_num_pages!=1):?>
		<div class="pagination">
			
			<?php previous_posts_link('&laquo; Previous') ?>
			<span class="current"><?php if($wp_query->query['paged']==''){ echo '1';}else{ echo $wp_query->query['paged']; } ?></span>
			of, or around <span class="total"><?php echo $wp_query->max_num_pages; ?></span>
			<?php next_posts_link('Next &raquo;') ?>
		</div><!-- .pagination -->
		<?php endif; ?>

	<?php else : ?>

		<h2 class="center">No Posts for Jolin!</h2>
		<p class="center">Sorry, but Jolin is a huge slacker and doesn't think her time should be spent on the betterment of mankind through posting on this site.</p>

	<?php endif; ?>

	</div>

<ul class="lungs">
	<?php dynamic_sidebar("Work Page"); ?>
</ul><!-- #callouts -->

<?php get_footer(); ?>
