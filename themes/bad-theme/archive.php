<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bad Theme
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			 
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
                            echo 'Catagory: <span>';
							single_cat_title();
                            echo '</span>';

						elseif ( is_tag() ) :
							echo 'Tag: <span>';
                            single_tag_title();
                            echo '</span>';

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'bad-theme' ), '<span class="vcard">' . get_the_author_meta('nickname') . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'bad-theme' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'bad-theme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'bad-theme' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'bad-theme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'bad-theme' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'bad-theme' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'bad-theme' );

						else :
							_e( 'Archives', 'bad-theme' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			

			<?php /* Start the Loop */ ?>
            			<ul class="article-list">
            <?php
            				while ( have_posts() ) : the_post();
            					$title = $post->post_title;
            					$excerpt = wp_trim_words(get_the_excerpt(), '30');
		
            					$start = ($wp_query->query_vars['paged'] == 0) ? 1 : (($wp_query->query_vars['paged'] - 1) * $wp_query->query_vars['posts_per_page']) + 1;
            					$end = $start + ($wp_query->query_vars['posts_per_page'] - 1);
            					$end = ($end > $wp_query->found_posts)? $wp_query->found_posts : $end;
            					$total = $wp_query->found_posts;
            					//$category = get_the_category($post->ID)[0];
            	?>

            					<li>
            	<?php
            					if(has_post_thumbnail()):
            	?>
                					<a href="<? echo get_permalink() ?>">
                						<span class="small"><?php the_post_thumbnail('thumbnail'); ?></span>
                                        <span class="wide"><?php the_post_thumbnail('wide'); ?></span>
                					</a>
            	<?php
            					endif;
            	?>
            						<h4><a href="<? echo get_permalink() ?>"><? echo $title ?></a></h4>
            						<p><? echo $excerpt ?></p>
            						<div class="meta">
            							<?php bad_theme_posted_on(); ?>
            						</div><!-- .entry-meta -->
            					</li>

            				<?php endwhile; ?>
            			</ul>

			<div class="pagination">
				<ul class="prev-next">
					<li class="prev"><?php previous_posts_link('&laquo; Prev', $wp_query->max_num_pages) ?></li>
					<li class="next"><?php next_posts_link('Next &raquo;', $wp_query->max_num_pages) ?></li>
				</ul>
			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->


<?php get_footer(); ?>
