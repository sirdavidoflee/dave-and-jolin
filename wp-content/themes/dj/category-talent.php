<?php get_header(); ?>

<?php $article_categories = get_categories(array(
                                    'child_of' => get_category_by_slug('work')->term_id
                            ));

	$talentChildren = get_categories(array('child_of' => get_category_by_slug('talent')->term_id));
 ?>
	

	<div class="heart">

	<?php if (have_posts()) : ?>
		
		<div class="post-list">
		
			<h1>The Talent</h1>


				<?php foreach($talentChildren as $talent): ?>
					<?php
					$talentSubChildren = new WP_Query();
					$talentSubChildren->query(array('category_name' => $talent->slug));
					?>
						<h2><?php echo $talent->name; ?></h2>
						<ul>
						<?php while ($talentSubChildren->have_posts()) : $talentSubChildren->the_post(); ?>
							<li>
								<?php talent_thumbnail(); ?>
								<h4>
									<a href="<?php the_permalink() ?>"><?php the_title(); ?></a> 
								</h4>
								<p><?php the_excerpt(); ?></p>
								<a href="<?php the_permalink() ?>">read on &raquo;</a> 

							</li>
						<?php endwhile; ?>
						</ul>
				<?php endforeach; ?>


				<?php if($wp_query->max_num_pages!=1):?>
				<div class="pagination">
					<?php previous_posts_link('&laquo; prev') ?>
					<span class="current"><?php echo $wp_query->query['paged']; ?></span>
					of <span class="total"><?php echo $wp_query->max_num_pages; ?></span>
					<?php next_posts_link('next &raquo;') ?>
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
	<?php dynamic_sidebar("Work Page"); ?>
</ul><!-- #callouts -->

<?php get_footer(); ?>
