	<div id="content">

		<!-- <?php the_post_thumbnail(THUMB_WIDTH, THUMB_HEIGHT, array('class' => ' main')); ?> -->
		
		<?php if(get_post_meta($post->ID, "Video", true)!=""):?>
				<?php 
				$height = get_post_meta($post->ID, "Height", true) + 16; ?>
				
				<iframe src="http://player.theplatform.com/ps/player/pds/I0Sxsoyz8z?pid=<?php echo get_post_meta($post->ID, "Video", true); ?>&amp;embedded=true" class="video">
					
				</iframe>

		<?php endif; ?>

		<!-- <div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div> -->


		<div class="post-head">
			<h1><?php the_title(); ?></h1>
			<p><?php meta_set_first("Client"); ?> <?php meta_set("Agency"); ?> <?php edit_post_link('Edit',' | ',''); ?></p>
			<?php the_tags( '<p><em>Tagged with:</em> ', ', ', '</p>'); ?>
		</div><!-- .post-head -->

		<div class="post-body">
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		
		<div class="pagination">
			<a href="<?php bloginfo('url'); ?>/work">&laquo; see all work</a>
		</div><!-- .pagination -->


	</div>
	<div id="callouts" class="work-detail">
		<?php dynamic_sidebar("Work Post"); ?>
	</ul><!-- #callouts -->