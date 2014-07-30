<!doctype html>
<html>
	<head>
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		
		<?php if(isset($metaDesc)): ?>
			<?php $metaDesc = str_replace('"', '', $metaDesc); ?>
			<meta name="description" content="<?php echo $metaDesc; ?>" />
		<?php endif; ?>
		
		<link rel="icon" href="/favicon.ico" type="image/x-icon" />

		<link rel="alternate" type="application/rss+xml" title="Dave and Jolin RSS" href="http://daveandjolin.com/feed" />

		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/sitewide.css" />
		
		<link rel="stylesheet" media="screen and (max-width: 738px)" href="<?php bloginfo('stylesheet_directory'); ?>/css/small.css" />
		
		<link rel="stylesheet" media="screen and (min-width: 738px) and (max-width: 1005px)" href="<?php bloginfo('stylesheet_directory'); ?>/css/bells.css" />
		
		<link rel="stylesheet" media="screen and (min-width: 1006px)" href="<?php bloginfo('stylesheet_directory'); ?>/css/whistles.css" />
		
		<link rel="stylesheet" media="screen and (min-width: 3000px)" href="<?php bloginfo('stylesheet_directory'); ?>/css/too-big.css" />
		
		<link rel="stylesheet" media="screen and (max-device-width: 480px)" href="<?php bloginfo('stylesheet_directory'); ?>/css/phone.css" />

		<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie7.css" /><![endif]-->

		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/sitewide.js"></script>
		
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
		
	</head>

<body <?php body_class(); ?>>
	<div id="skin">
		<div class="torso clearfix">