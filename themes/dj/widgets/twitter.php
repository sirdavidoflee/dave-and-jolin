<?php
$userID = $wp_query->post->ID;
$twitterUser = get_post_meta($userID, "Twitter", true);

if($twitterUser!=NULL):
?>

<div id="twitterFeed" class="project-list">
	<a class="tag" href="http://twitter.com/<?php echo $twitterUser; ?>" target="_blank">Twitter &raquo;</a>
	<dl>
		<dt>Latest Thoughts</dt>
		<dd>
			<blockquote><?php get_latest_tweet($twitterUser); ?></blockquote> <!-- <span class="when">&mdash; 3 hours ago</span> -->
		</dd>
	</dl>
</div><!-- #twitterFeed -->

<?php endif; ?>