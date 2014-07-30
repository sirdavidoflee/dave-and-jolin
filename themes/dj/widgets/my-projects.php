<?php 
	$results = $wpdb->get_results('SELECT DISTINCT post_id FROM wp_postmeta WHERE meta_key = "involved_users" and meta_value LIKE "%'.$post->ID.'%";', ARRAY_A); 
	
	$posts = array();
	if($results!=null){

		foreach($results as $post_id) {
			$posts[] = (int)$post_id['post_id'];
		}

?>


<div id="myProjects" class="simple-list">
	<dl>
		<dt>More on My Projects</dt>
		<dd>
			<ul>

<?php

foreach ($posts as &$postName) {
	$peoplePosts = new WP_Query();
	$peoplePosts->query(array('p' => $postName));
	?>
	<?php if($peoplePosts->have_posts()): ?>

		<?php while ($peoplePosts->have_posts()) : $peoplePosts->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<p><?php echo myTruncate(get_the_excerpt(), 45, " "); ?></p>
			</li>
			
			
		<?php endwhile; ?>

	<?php endif; ?>
	

<?php } ?>
	</ul>
</dd>
</dl>
</div><!-- #whosInvolved -->
<?php } ?>

