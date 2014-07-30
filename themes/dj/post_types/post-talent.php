<?php $category = get_the_category();
$query = substr_replace($category[0]->name, " ", strlen($category[0]->name)-1);
?>
	<div id="content" class="heart" role="main">

		<!-- <div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div> -->

		<?php if(get_post_meta($post->ID, "Video", true)!=""):?>
				<?php 
				$height = get_post_meta($post->ID, "Height", true) + 16; ?>
				
				<iframe src="http://player.theplatform.com/ps/player/pds/<?php echo get_post_meta($post->ID, "Video", true); ?>" class="director-video">
					
				</iframe>

		<?php endif; ?>

		<div class="post-head">
				
			<?php
				if (has_post_thumbnail()): ?>
					<span class="img"><?php the_post_thumbnail('thumbnail'); ?></span>
				<?php else: ?>
					<?php $rand = rand(1, 4); ?>
					<span class="img"><img src="<?php bloginfo('stylesheet_directory')?>/img/default-thumbnail-<?php echo $rand ?>.gif" alt="title" title="title" class="no-img" width="126" height="95" /></span>
				<?php endif;?>
			
			<h1><?php the_title(); ?> <a class="email" href="mailto:<?php echo get_post_meta($post->ID, "Email", true); ?>">email</a></h1>
			<p>
				<em>Title:</em> 
					<?php if(get_post_meta($post->ID, "Title", true)){ ?>
						<?php echo get_post_meta($post->ID, "Title", true); }
						else{ echo $query; } ?> 
				<?php meta_set_link('Website'); ?> <?php edit_post_link('Edit',' | ',''); ?></p>
			<?php the_tags( '<p><em>Specialties:</em> ', ', ', '</p>'); ?>
			
		</div><!-- .post-head -->


		<div class="post-body">

			<div class="entry">
				<?php the_content('<p>Read the rest of this entry &raquo;</p>'); ?>

			</div>
		</div>
		
	<?php //comments_template(); ?>
		<div class="pagination">
			<a href="<?php bloginfo('url'); ?>/talent">&laquo; see all talent</a>
		</div><!-- .pagination -->
	</div><!-- #content -->

<ul class="lungs">
	<?php dynamic_sidebar("Talent Post"); ?>
</div>