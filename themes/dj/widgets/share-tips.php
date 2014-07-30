<?php

/**
 * Share Tips Widget
 *
 * @author Mark Robert Henderson
 */
    
    $shareTips = new WP_Query();
    $shareTips->query(array('category_name' => "Tips",
                            'orderby' => "rand",
                            'showposts' => 1));

?>



<div id="shareTips" class="callout">
	<dl>
		<dt>Share Tips!</dt>
		<dd>
		    <?php while ($shareTips->have_posts()) : $shareTips->the_post(); ?>
			<blockquote><?php the_excerpt(); ?></blockquote>
			<span>- <?php echo get_post_meta($post->ID, "Tip Author", true); ?></span>
		    <?php endwhile; ?>
		</dd>
	</dl>
</div><!-- #shareTips -->