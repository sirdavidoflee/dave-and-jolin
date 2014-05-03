<?php

/**
 * Coupons Widget
 *
 * @package default
 * @author Mark Robert Henderson
 */

$coupons = new WP_Query();
$coupons->query(array('category_name' => "coupons",
                      'orderby' => 'rand',
                      'showposts' => 3));
?>
<div id="coupons" class="box1">
	<dl>
		<dt>coupons</dt>
		<dd>
			<ul>
			    <?php while( $coupons->have_posts()): $coupons->the_post(); ?>
				    <li>
				    	<a href="<?php bloginfo('url'); ?>/coupons"><?php the_post_thumbnail(); ?></a>
				    	<h4><a href="<?php bloginfo('url'); ?>/coupons"><?php the_title(); ?></a></h4>
				    	<p><?php echo myTruncate(get_the_excerpt(), 50, " "); ?> <a href="<?php bloginfo('url'); ?>/coupons">more</a></p>
				    </li>
				<?php endwhile; ?>
			</ul>
			<a class="btn go next" href="<?php bloginfo('url'); ?>/coupons">view more</a>
		</dd>
	</dl>
</div><!-- #coupons -->