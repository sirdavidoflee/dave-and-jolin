<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */




$cat = get_the_category();
$category_query = new WP_Query('posts_per_page=2&offset=1&cat=' . $cat->cat_ID);
$category_query->query_vars[ 'paged' ] > 1 ? $current = $category_query->query_vars[ 'paged' ] : $current = 1;

$featured_query = new WP_Query('posts_per_page=1&cat=' . $cat->cat_ID);

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<h1><? echo $cat->name ?></h1>

			<ul class="article-list">
<?php 
			if ( have_posts() ) :
				
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
	</div><!-- #primary -->
<?php get_footer(); ?>
