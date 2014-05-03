<?php get_header(); ?>

<?php $article_categories = get_categories(array(
                                    'child_of' => get_category_by_slug('work')->term_id
                            )); ?>
	

	<div class="heart">

	<?php if (have_posts()) : ?>
		
		<div class="work-list">
		
			<ul class="clearfix">

			<?php while (have_posts()) : the_post(); ?>
				
				<li>
					<a href="<?php the_permalink() ?>">
						<?php default_thumbnail(); ?>
						<?php echo myTruncate(get_the_title(), 15, " "); ?>
					</a>
					<p><?php echo myTruncate(get_the_excerpt(), 45, " "); ?></p>
				</li>

			<?php endwhile; ?>
		
		
		</div>
		
		<?php if($wp_query->max_num_pages!=1):?>
		<div class="pagination">
			<?php previous_posts_link('&laquo; prev') ?>
			<span class="current"><?php if($wp_query->query['paged']==''){ echo '1';}else{ echo $wp_query->query['paged']; } ?></span>
			of <span class="total"><?php echo $wp_query->max_num_pages; ?></span>
			<?php next_posts_link('next &raquo;') ?>
		</div><!-- .pagination -->
		<?php endif; ?>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<ul class="lungs">
	<?php dynamic_sidebar("Work Page"); ?>
</ul><!-- #callouts -->

<?php get_footer(); ?>
