<?php

/**
 * Include file for defining WP editor shortcodes
 *
 * @author Mark Robert Henderson
 */

// [definition term="post-name"]content text here[/definition]
function definitiontag_func($atts, $content) {
    extract($atts);
    $term = sanitize_title_with_dashes($term);
    
	return '<a class="tooltip" href="glossary.html#'.$term.'">' . $content . '</a>';
}
add_shortcode('definition', 'definitiontag_func');
