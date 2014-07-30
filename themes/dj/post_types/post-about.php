<div id="content" class="about-detail">

	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

		<div class="post-head">
			<h1><?php the_title(); ?></h1>
			<?php edit_post_link('Edit','',''); ?></p>
		</div><!-- .post-head -->
		<div class="post-body clearfix">
			
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
		</div>
		<div class="pagination">
			<a href="<?php bloginfo('url'); ?>/about">&laquo; back to about</a>
		</div><!-- .pagination -->
	</div>

</div>

<ul class="lungs">
	<?php dynamic_sidebar("Work Page"); ?>
</ul><!-- #callouts -->