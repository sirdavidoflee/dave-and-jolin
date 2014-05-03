	<div id="content" class="heart" role="main">
		
		

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

			<div class="post-head">
				<?php postnail(); ?>
				<h1><?php the_title(); ?></h1>
				<?php the_tags( '<p><em>Tagged with:</em> ', ', ', '</p>'); ?>
				<?php edit_post_link('Edit','',''); ?>
			</div><!-- .post-head -->
			<div class="post-body">
				
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				
				<h6>Posted by <?php echo get_the_author(); ?></h6>
			</div>
			
			<div class="pagination">
				<a href="<?php bloginfo('url'); ?>/dave">&laquo; back to Joint List</a>
			</div><!-- .pagination -->
		</div>

	</div>

	<ul class="lungs">
		<?php dynamic_sidebar("Blog Page"); ?>
	</ul><!-- #callouts -->