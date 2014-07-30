<?php get_header(); ?>

<?php 

	$article_categories = get_categories(array('child_of' => get_category_by_slug('work')->term_id));
	
	$blogPosts = new WP_Query();
	$blogPosts->query(array('category_name' => "blog", 'showposts'=>6));

?>
	
	<div id="aboutHeader">
		<h1><span class="open-quote">&#8220;</span><?php echo category_description($category); ?><span class="close-quote">&#8221;</span></h1>
	</div>	

	<div class="heart">

	<?php if (have_posts()) : ?>
		
		<div class="about-list">
		
			<ul>

			<?php while (have_posts()) : the_post(); ?>
				
				<li>
					<h3><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h3>
					<p><?php echo get_the_excerpt(); ?></p>
					<a href="<?php the_permalink() ?>">read on &raquo;</a>
				</li>

			<?php endwhile; ?>

			</ul>
		
		</div><!-- .about-list -->

	<?php endif; ?>
	
	</div><!-- #content -->

	<ul class="lungs">

		<div id="ourBlog" class="project-list">
			<h3><a href="<?php bloginfo('url'); ?>/blog">The Feed</a></h3>
			<?php echo category_description(get_category_by_slug('blog')->term_id); ?>
			<dl>
				<dt>Latest from the feed:</dt>
				<dd>
					<ul>
						<?php if($blogPosts->have_posts()): ?>
							<?php while ($blogPosts->have_posts()) : $blogPosts->the_post(); ?>
								<li>
									<a href="<?php the_permalink() ?>">
										<?php if (has_post_thumbnail()): ?>
											<span class="img"><?php the_post_thumbnail(); ?></span>
										<?php else:
											$rand = rand(1, 4); ?>
											<span class="img">
												<img src="<?php echo get_bloginfo('stylesheet_directory') . '/img/default-thumbnail-'.$rand.'.gif'; ?>" alt="title" title="title" class="no-img" /></span>
										<?php endif; ?>

										<?php echo myTruncate(get_the_title(), 30, " "); ?>
									</a>
								</li>
							<?php endwhile; ?>
						<?php endif; ?>
					</ul>
				</dd>
			</dl>
			<a href="<?php bloginfo('url'); ?>/blog">read all posts &raquo;</a>
		</div><!-- #ourBlog -->
			
	</ul><!-- #callouts -->

<?php get_footer(); ?>
