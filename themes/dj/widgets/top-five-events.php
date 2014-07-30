<?php

/**
 * Top 5 Events
 *
 * @uses popular posts plugin
 * @author Mark Robert Henderson
 */

?>

<div id="top5" class="events list">
	<dl>
		<dt>Top 5 Events Everyone Should Go</dt>
		<dd>
		    <?php popular_posts(); ?>
			<a class="btn go next" href="<?php bloginfo('url'); ?>/events">view all events</a>
		</dd>
	</dl>
</div><!-- #top5 -->