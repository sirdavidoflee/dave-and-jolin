<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Bad Theme
 */
	if(has_post_thumbnail($post->ID) && !is_front_page()) {
		$siteImg = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	} elseif(is_front_page()) {
		$siteImg = 'http://probablybad.com/wp-content/themes/bad-theme/img/share-logo-square.jpg';
	} else {
		$siteImg = 'http://probablybad.com/wp-content/themes/bad-theme/img/share-logo-square.jpg';
	}
	$daveChildren = get_categories(array(
		'child_of' => get_category_by_slug('dave')->term_id
	));
	$jolinChildren = get_categories(array(
		'child_of' => get_category_by_slug('jolin')->term_id
	));
	$jointChildren = get_categories(array(
		'child_of' => get_category_by_slug('joint')->term_id
	));

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, width=device-width" />

<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<meta name="description" content="One way or another, every movie, tv show, or video game is probably bad. We will tell you why." />
<meta property="og:image" content="<?php echo $siteImg ?>" />

<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,700|ABeeZee|Varela' rel='stylesheet' type='text/css'>

<?php wp_head(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6380462-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript" src="/wp-content/themes/bad-theme/js/libs/jquery.1.10.0.min.js"></script>
<script type="text/javascript" src="/wp-content/themes/bad-theme/js/sitewide.js"></script>

</head>

<body <?php body_class(); ?>>
	
	<header>
		<div class="inner">
			<h1><span class="show-dave">Dave</span> <span class="amp">&amp;</span> <span class="show-jo">Jolin</span></h1>
		</div>
		<nav>
			<div class="nav-bg"></div>
			<div class="nav-dave">
				<h2>Dave's List</h2>
				<ul>
				<?php foreach($daveChildren as $daves): ?>
					<li><a href="<?php bloginfo('url'); ?>/dave/<?php echo $daves->slug; ?>"><?php echo $daves->name; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="nav-jo">
				<h2>Jolin's List</h2>
				<ul>
				<?php foreach($jolinChildren as $jos): ?>
					<li><a href="<?php bloginfo('url'); ?>/jolin/<?php echo $jos->slug; ?>"><?php echo $jos->name; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<div class="nav-both">
				<h2>Joint List</h2>
				<ul>
				<?php foreach($jointChildren as $joint): ?>
					<li><a href="<?php bloginfo('url'); ?>/joint/<?php echo $joint->slug; ?>"><?php echo $joint->name; ?></a></li>
				<?php endforeach; ?>
				</ul>
			</div>
		</nav>
		<form action="/" method="get">
			<input type="search" name="s" placeholder="Search" />
		</form>
		<a href="/" class="back-home">&lt; home</a>
	</header>
	
<div id="page" class="hfeed site">
	

	<section class="bad-content">
