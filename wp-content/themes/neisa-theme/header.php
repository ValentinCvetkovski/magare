<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package neisa-theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">









		    <!-- Fixed navbar -->
	    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	        	<a href="<?php echo home_url(); ?>">
			      <img src="<?php bloginfo('template_directory'); ?> /images/logo.svg' ?>"  alt="<?= esc_attr( get_bloginfo( 'name' ) ); ?>">
			    </a>
	        </div>


	        <div id="navbar" class="navbar-collapse collapse">
	          <ul class="nav navbar-nav">
	            <li class="active"><a href="index.html">Start</a></li>
	            <li><a href="om.html">Om Neisa</a></li>
	            <li><a href="tjanster.html">Våra tjänster</a></li>
	            <li><a href="kontakt.html">Kontakt</a></li>


	            <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
	              <ul class="dropdown-menu" role="menu">
	                <li><a href="#">Action</a></li>
	                <li><a href="#">Another action</a></li>
	                <li><a href="#">Something else here</a></li>
	                <li class="divider"></li>
	                <li class="dropdown-header">Nav header</li>
	                <li><a href="#">Separated link</a></li>
	                <li><a href="#">One more separated link</a></li>
	              </ul>
	            </li>


	          </ul>
	          <ul class="nav navbar-nav navbar-right">
	            <li><a href="../navbar/">Eng</a></li>
	            <!-- <li><a href="../navbar-static-top/">Swe</a></li> -->
	            <li class="active"><a href="./">Sv <span class="sr-only">(current)</span></a></li>
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </nav>

<div id="header">
  <div class="container">
    <div class="news">
        <h1>”Insert a Flex Slider here!”</h1>
    </div><!-- /news -->
  </div><!-- /container -->
</div><!-- /header -->













	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<!-- <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'neisa-theme' ); ?></a> -->
		<!--<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div><!- .site-branding -->

		<!--<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Primary Menu', 'neisa-theme' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!- #site-navigation -->
