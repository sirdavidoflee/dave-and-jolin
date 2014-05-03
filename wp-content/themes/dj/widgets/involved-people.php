<?php
$postID = get_post_meta($post->ID, "involved_users", false);

?>

<div id="whosInvolved" class="talent-list">
	<dl>
		<dt>Involved in this Project</dt>
		<dd>
			<ul>

<?php
foreach ($postID as &$postName) {

	$peoplePosts = new WP_Query();
	$peoplePosts->query(array('p' => $postName));
	?>
	<?php if($peoplePosts->have_posts()): ?>

		<?php while ($peoplePosts->have_posts()) : $peoplePosts->the_post(); ?>
			<li>
				<span class="img"><a href="<?php the_permalink(); ?>"><?php search_thumbnail(); ?></a></span>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php
				$category = get_the_category();
				?>
				<a class="tag" href="<?php bloginfo('url'); ?>/talent"><?php echo $category[0]->name; ?></a>
			</li>
			
			
		<?php endwhile; ?>

	<?php endif; ?>
	

<?php } ?>
	</ul>
</dd>
</dl>
</div><!-- #whosInvolved -->

