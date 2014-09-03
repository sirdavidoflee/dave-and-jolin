<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Bad Theme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php edit_post_link( __( 'Edit', 'bad-theme' ), '<span class="edit-link">', '</span>' ); ?>
	

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'bad-theme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
