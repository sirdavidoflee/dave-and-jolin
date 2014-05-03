<?php

/**
 * Helpful Videos Widget
 *
 * @author Mark Robert Henderson
 */

    $helpfulVideos = new WP_Query();
    $helpfulVideos->query(array('category_name' => "videos",
                                'showposts' => 3,
                                'orderby' => 'rand'));
                            
?>

<div id="helpfulVideos" class="box1">
	<dl>
		<dt>Helpful Videos</dt>
		<dd>
			<ul>
				<?php while($helpfulVideos->have_posts()): $helpfulVideos->the_post(); ?>
				    <li>
				    	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				    	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				    	<p><?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>">more</a></p>
				    </li>
				<?php endwhile; ?>
			</ul>
			<a class="btn go next" href="<?php bloginfo('url'); ?>/videos">see all videos</a>
		</dd>
	</dl>
</div><!-- #helpfulVideos -->