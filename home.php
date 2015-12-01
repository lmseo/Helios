<?php

add_action( 'genesis_meta', 'streamline_home_genesis_meta' );
/**
 * Add widget support for homepage.
 *
 */
function streamline_home_genesis_meta() {
	if ( is_active_sidebar( 'home-featured-1' ) || is_active_sidebar( 'home-featured-2' ) || is_active_sidebar( 'home-featured-3' ) ) {
		add_action( 'genesis_before_content_sidebar_wrap', 'streamline_home_loop_helper' );
	}
}
/**
 * Display widget content for home featured sections.
 *
 */
function streamline_home_loop_helper() {

	if ( is_active_sidebar( 'home-featured-1' ) || is_active_sidebar( 'home-featured-2' ) || is_active_sidebar( 'home-featured-3' ) ) {

		echo '<div id="home-featured">';

		echo '<div class="home-featured-1">';
		dynamic_sidebar( 'home-featured-1' );
		echo '</div><!-- end .home-featured-1 -->';	

		echo '<div class="home-featured-2">';
		dynamic_sidebar( 'home-featured-2' );
		echo '</div><!-- end .home-featured-2 -->';

		echo '<div class="home-featured-3">';
		dynamic_sidebar( 'home-featured-3' );
		echo '</div><!-- end .home-featured-3 -->';

		echo '</div><!-- end #home-featured -->';	
	}
}
//add_theme_support('genesis-footer-widgets');

remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_before_content_sidebar_wrap', 'lmseo_homepage_content' );
function lmseo_homepage_content() {
	$out .='';
	require_once ( get_stylesheet_directory() . '/lib/partials/featured-banner.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/tap-titles.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/catalog.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/projects.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/social.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/services.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/recent-posts.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/contact.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/about.php' );
	
	//require_once ( get_stylesheet_directory() . '/lib/partials/header.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/featured-banner.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/tap-titles.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/projects.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/social.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/recent-posts.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/contact.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/about.php' );
	//require_once ( get_stylesheet_directory() . '/lib/partials/footer.php' );
	echo $out;
}
genesis();