<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');
require_once ( get_stylesheet_directory() . '/lib/functions/html5.php' );
 
//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

/*add_filter('language_attributes', 'modernizr_no_js');
function modernizr_no_js($output) {
    return $output . ' class="no-js"';
}*/

/*add_action( 'genesis_meta', 'sp_viewport_meta_tag' );
function sp_viewport_meta_tag() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1"/>';
}*/
/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'LMSEO' );
define( 'CHILD_THEME_URL', 'http://www.lmseo.com/' );

/** Custom Post Types */
require_once(  get_stylesheet_directory(  ) . '/include/cpt/super-cpt.php'   );
require_once(  get_stylesheet_directory(  ) . '/include/cpt/zp_cpt.php'   );

/** Theme Option/Functions */
require_once (  get_stylesheet_directory(  ) . '/include/theme_settings.php'   );
require_once (  get_stylesheet_directory(  ) . '/include/theme_functions.php'   );

/* Include Update Notice File  */
require_once(  get_stylesheet_directory(  )  .'/include/updater/theme_updater.php'   );

/** Theme Widgets */
require_once(  get_stylesheet_directory(  )  .'/include/widgets/widget-flickr.php'   );
require_once(  get_stylesheet_directory(  )  .'/include/widgets/widget-address.php'   );
require_once(  get_stylesheet_directory(  )  .'/include/widgets/widget-social_icons.php'   );
require_once(  get_stylesheet_directory(  )  .'/include/widgets/widget-latest_portfolio.php'   );
require_once(  get_stylesheet_directory(  )  .'/include/widgets/widget-cta-after-content.php'   );

/** Theme Shortcode */
require_once(  get_stylesheet_directory(  ) . '/include/shortcodes/shortcode.php'   );

/** Unregister Layout */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );


/** Unregister Sidebar */
unregister_sidebar(  'header-right'  );
unregister_sidebar( 'sidebar-alt' );

/** Add Viewport meta tag for mobile browsers */
add_action( 'genesis_meta', 'streamline_add_viewport_meta_tag' );
function streamline_add_viewport_meta_tag() {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

add_action(  'wp_enqueue_scripts', 'lmseo_print_styles');
function lmseo_print_styles(   ) {
	//wp_register_style(  'flexslider-css', get_stylesheet_directory_uri(   ).'/css/flexslider.css' , '', '3.1.5' ); using Bower with an updated version of Flexslider
	wp_register_style(  'flexslider-css', get_stylesheet_directory_uri(   ).'/bower_components/flexslider/flexslider.css' , '', '2.5.0' );
}
add_action(  'wp_enqueue_scripts', 'lmseo_theme_js'  );
function lmseo_theme_js(   ) {	
	wp_deregister_script('jquery');
	// Register
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false, '2.1.4',false);
	// jQuery Migrate
	// Deregister core jQuery Migrate
	wp_deregister_script('jquery-migrate');
	// Register
	wp_register_script('jquery-migrate', 'https://code.jquery.com/jquery-migrate-1.2.1.min.js', array('jquery'), '1.2.1',false); // require jquery, as loaded above
	wp_register_script( 'modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2', false );
	wp_register_script( 'foundation',get_stylesheet_directory_uri(  ) . '/bower_components/foundation/js/foundation.min.js',array( 'jquery' ), '5.5.2', true );
	wp_register_script( 'foundation_app', get_stylesheet_directory_uri(  ) . '/lib/js/app.js',array( 'foundation' ), '1.0', true );
	wp_register_script( 'blueimp_helper',get_stylesheet_directory_uri(  ) . '/bower_components/blueimp-gallery/js/blueimp-helper.js',array( 'jquery' ), '5.5.2', true );
	wp_register_script( 'blueimp',get_stylesheet_directory_uri(  ) . '/bower_components/blueimp-gallery/js/jquery.blueimp-gallery.min.js',array( 'jquery' ), '5.5.2', true );
	
  /*  <script src="http://' . $_SERVER['HTTP_HOST'].'/wp-content/themes/luis/lib/js/bower_components/foundation/js/foundation.min.js"></script>
    <script src="http://' . $_SERVER['HTTP_HOST'].'/wp-content/themes/luis/lib/js/app.js"></script>
    <script src="http://' . $_SERVER['HTTP_HOST'].'/wp-content/themes/luis/bower_components/blueimp-gallery/js/blueimp-helper.js"></script>
    <script src="http://' . $_SERVER['HTTP_HOST'].'/wp-content/themes/luis/bower_components/blueimp-gallery/js/jquery.blueimp-gallery.min.js">
    </script>*/
    
}

add_action(  'wp_enqueue_scripts', 'lmseo_enque_scripts'  );
function lmseo_enque_scripts(   ) {
	wp_enqueue_script(  'jquery');
	wp_enqueue_script(  'jquery-migrate');
	wp_enqueue_script(  'modernizr');
	wp_enqueue_script(  'foundation');
	wp_enqueue_script(  'foundation_app');
	wp_enqueue_script(  'blueimp_helper');
	wp_enqueue_script(  'blueimp');
	
}
//* Remove the site title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

/** Create additional color style options */
//add_theme_support( 'genesis-style-selector', array( 'streamline-blue' => 'Blue', 'streamline-green' => 'Green' ) );

/** Remove favicon */
remove_action('wp_head', 'genesis_load_favicon');

/*add new favicons */
add_action('wp_head','lmseo_favicon');
function lmseo_favicon(){ ?>
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#008cc0">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#ffffff"><?php
}

/*customize breadcrummbs */
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
/*add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
	$args['home'] = 'Home';
	$args['sep'] = '</li><li>';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<nav class="breadcrumb"><div class="row">';
	$args['suffix'] = '</div></nav>';
	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories'] = true; // Genesis 1.5 and later
	$args['display'] = true;
	$args['labels']['prefix'] = '<li><span class="home"></span></li>';
	$args['labels']['author'] = 'Archives for ';
	$args['labels']['category'] = 'Archives for '; // Genesis 1.6 and later
	$args['labels']['tag'] = 'Archives for ';
	$args['labels']['date'] = 'Archives for ';
	$args['labels']['search'] = 'Search for ';
	$args['labels']['tax'] = 'Archives for ';
	$args['labels']['post_type'] = 'Archives for ';
	$args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
return $args;
}*/
add_action( 'genesis_after_header', 'custom_breadcrumbs' );
function custom_breadcrumbs(){
	if(is_home() or is_front_page()){
	}else {
		echo '<div class="row"><nav class="custom-breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
	    if(function_exists('bcn_display')){
	        bcn_display();
	    }
		echo '</nav></div>';
	}
}

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'footer-widgets', 'footer' ) );
/* row class as structural wrap*/
add_action( 'genesis_before_content_sidebar_wrap', 'opening_header_divs', 9 );
function opening_header_divs() {
	if ( is_front_page() or is_home()) {
		
	} else {
		echo '<div class="row">';
	  //everything else
	}
}

add_action( 'genesis_after_content_sidebar_wrap', 'closing_header_divs' );
function closing_header_divs() {
	if(is_home() or is_front_page()){
		
	}else {
		echo '</div>';
	  //everything else
	}
}

add_action( 'genesis_before_content', 'opening_main_divs', 9 );
function opening_main_divs() {
	if ( is_front_page() or is_home()) {
		
	} else {
		echo '<div class="row"><div class="large-9 columns">';
	  //everything else
	}
}

add_action( 'genesis_after_content', 'closing_main_divs' );
function closing_main_divs() {
	if(is_home() or is_front_page()){
		
	}else {
		echo '</div>';
	  //everything else
	}
}


add_action( 'genesis_before_sidebar_widget_area', 'opening_aside_divs', 9 );
function opening_aside_divs() {
	if ( is_front_page() or is_home()) {
		
	} else {
		echo '</div><div class="large-3 columns">';
	  //everything else
	}
}

add_action( 'genesis_after_sidebar_widget_area', 'closing_aside_divs' );
function closing_aside_divs() {
	if(is_home() or is_front_page()){
		
	}else {
		echo '</div>';
	  //everything else
	}
}
/** Add new image sizes */
add_image_size( 'home-featured', 255, 80, TRUE );
add_image_size( 'post-image', 642, 250, TRUE );

/** Unregister layout settings */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

/** Unregister secondary sidebar */
unregister_sidebar( 'sidebar-alt' );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 120 ) );

/** Add newsletter section after header */
//add_action( 'genesis_before_content_sidebar_wrap', 'streamline_newsletter' );
//function streamline_newsletter() {
  /* if ( ! is_home() )
       return;

   genesis_widget_area( 'newsletter', array(
       'before' => '<div class="newsletter widget-area">',
   ) );*/
//}

/** Reposition the breadcrumbs */
/*remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_do_custom_loop' );

 
function child_do_custom_loop() {
 
    global $paged; // current paginated page
    global $query_args; // grab the current wp_query() args
    $args = array(
        'category__not_in' => 42, // exclude posts from this category
        'paged'            => $paged, // respect pagination
    );
 
    genesis_custom_loop( wp_parse_args($query_args, $args) );
 
}*/

/** Customize breadcrumbs display */
/*
add_filter( 'genesis_breadcrumb_args', 'streamline_breadcrumb_args' );
function streamline_breadcrumb_args( $args ) {
	$args['home'] = 'Home';
	$args['sep'] = ' ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb"><div class="inner">';
	$args['suffix'] = '</div></div>';
	$args['labels']['prefix'] = '<span class="home"></span>';
	return $args;
}*/
/*<nav>
   <h2>You are here:</h2>
   <ul id="navlist">
   <li><a href="/">Main</a> →</li> 
   <li><a href="/products/">Products</a> →</li> 
   <li><a href="/products/dishwashers/">Dishwashers</a> →</li> 
   <li><a>Second hand</a></li> 
   </ul>
   </nav> 


   <nav class="appbar-nav">
   <ul class="breadcrumbs" data-tracking-cat="breadcrumbs">
   <li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a class="product-icon" href="//www.google.com/webmasters/">
   <img alt="Webmaster Tools" src="https://www.google.com/images/icons/product/webmaster_tools-16.png"></a>
   <a class="crumb product-name" href="//www.google.com/webmasters/" itemprop="url"><span itemprop="title">Webmaster Tools</span></a></li>
   <li class="crumb-container" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" style="z-index:3"><a class="crumb crumb--first" href="/webmasters/?hl=en#topic=3309300" itemprop="url"><span class="breadcrumb-text" title="Help" itemprop="title">Help</span></a></li>
   <li class="crumb-container" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" style="z-index:2"><a class="crumb" href="/webmasters/topic/4598337?hl=en&amp;ref_topic=3309300" itemprop="url"><span class="breadcrumb-text" title="Use structured data for rich search results" itemprop="title">Use structured data for rich search results</span></a></li>
   <li class="crumb-container" itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb" style="z-index:1"><a class="crumb crumb--last" href="/webmasters/topic/4599102?hl=en&amp;ref_topic=4598337" itemprop="url"><span class="breadcrumb-text" title="Structured data types" itemprop="title">Structured data types</span></a></li>
   </ul>
   </nav>*/

/** Add post image above post title */
add_action( 'genesis_before_post', 'streamline_post_image' );
function streamline_post_image() {

	if ( is_page() ) return;

	if ( $image = genesis_get_image( 'format=url&size=post-image' ) ) {
		printf( '<a href="%s" rel="bookmark"><img class="post-photo" src="%s" alt="%s" /></a>', get_permalink(), $image, the_title_attribute( 'echo=0' ) );
	}

}

/** Relocate the post info function */
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
add_action( 'genesis_before_post', 'genesis_post_info' );

/** Customize the post info function */
add_filter( 'genesis_post_info', 'post_info_filter' );
function post_info_filter($post_info) {
if ( !is_page() ) {
    $post_info = '[post_author_posts_link] [post_date] [post_comments] [post_edit]';
    return $post_info;
}}

/** Add markup around post class */
add_action( 'genesis_before_post', 'streamline_post_markup' );
	function streamline_post_markup() { ?>
	<div class="post-wrap row">
	<?php
}
add_action( 'genesis_after_post', 'streamline_post_markup_close' );
	function streamline_post_markup_close() { ?>
	</div>
	<?php
}

/** Modify the size of the Gravatar in the author box */
add_filter( 'genesis_author_box_gravatar_size', 'streamline_author_box_gravatar_size' );
function streamline_author_box_gravatar_size($size) {
    return '80';
}

/** Customize the post meta function */
add_filter( 'genesis_post_meta', 'post_meta_filter' );
function post_meta_filter($post_meta) {
if ( !is_page() ) {
    $post_meta = '[post_categories before="Filed Under: "] [post_tags before="Tagged: "]';
    return $post_meta;
}}

/** Add the after post section */
add_action( 'genesis_after_post_content', 'streamline_after_post' );
function streamline_after_post() {
	if ( ! is_singular( 'post' ) )
	return;
	genesis_widget_area( 'after-post', array(
		'before' => '<div class="after-post widget-area">',
   ) );
}

/** Add Olark to website */
add_action( 'wp_footer','lmseo_olark' );
function lmseo_olark(){
	?>
	<!-- begin olark code -->
	<!-- begin olark code -->
	<script data-cfasync="false" type='text/javascript'>/*<![CDATA[*/window.olark||(function(c){var f=window,d=document,l=f.location.protocol=="https:"?"https:":"http:",z=c.name,r="load";var nt=function(){
	f[z]=function(){
	(a.s=a.s||[]).push(arguments)};var a=f[z]._={
	},q=c.methods.length;while(q--){(function(n){f[z][n]=function(){
	f[z]("call",n,arguments)}})(c.methods[q])}a.l=c.loader;a.i=nt;a.p={
	0:+new Date};a.P=function(u){
	a.p[u]=new Date-a.p[0]};function s(){
	a.P(r);f[z](r)}f.addEventListener?f.addEventListener(r,s,false):f.attachEvent("on"+r,s);var ld=function(){function p(hd){
	hd="head";return["<",hd,"></",hd,"><",i,' onl' + 'oad="var d=',g,";d.getElementsByTagName('head')[0].",j,"(d.",h,"('script')).",k,"='",l,"//",a.l,"'",'"',"></",i,">"].join("")}var i="body",m=d[i];if(!m){
	return setTimeout(ld,100)}a.P(1);var j="appendChild",h="createElement",k="src",n=d[h]("div"),v=n[j](d[h](z)),b=d[h]("iframe"),g="document",e="domain",o;n.style.display="none";m.insertBefore(n,m.firstChild).id=z;b.frameBorder="0";b.id=z+"-loader";if(/MSIE[ ]+6/.test(navigator.userAgent)){
	b.src="javascript:false"}b.allowTransparency="true";v[j](b);try{
	b.contentWindow[g].open()}catch(w){
	c[e]=d[e];o="javascript:var d="+g+".open();d.domain='"+d.domain+"';";b[k]=o+"void(0);"}try{
	var t=b.contentWindow[g];t.write(p());t.close()}catch(x){
	b[k]=o+'d.write("'+p().replace(/"/g,String.fromCharCode(92)+'"')+'");d.close();'}a.P(2)};ld()};nt()})({
	loader: "static.olark.com/jsclient/loader0.js",name:"olark",methods:["configure","extend","declare","identify"]});
	/* custom configuration goes here (www.olark.com/documentation) */
	olark.identify('7020-153-10-7829');/*]]>*/</script><noscript><a href="https://www.olark.com/site/7020-153-10-7829/contact" title="Contact us" target="_blank">Questions? Feedback?</a> powered by <a href="http://www.olark.com?welcome" title="Olark live chat software">Olark live chat software</a></noscript>
	<!-- end olark code -->
<?php
}
remove_filter( 'comment_form_defaults', 'genesis_comment_form_args' );


/** Register widget areas */
genesis_register_sidebar( array(
	'id'				=> 'newsletter',
	'name'			=> __( 'Newsletter', 'streamline' ),
	'description'	=> __( 'This is the newsletter section below the navigation.', 'streamline' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-featured-1',
	'name'			=> __( 'Home Featured #1', 'streamline' ),
	'description'	=> __( 'This is the featured #1 column on the homepage.', 'streamline' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-featured-2',
	'name'			=> __( 'Home Featured #2', 'streamline' ),
	'description'	=> __( 'This is the featured #2 column on the homepage.', 'streamline' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'home-featured-3',
	'name'			=> __( 'Home Featured #3', 'streamline' ),
	'description'	=> __( 'This is the featured #3 column on the homepage.', 'streamline' ),
) );
genesis_register_sidebar( array(
	'id'				=> 'after-post',
	'name'			=> __( 'After Post', 'streamline' ),
	'description'	=> __( 'This is the after post section.', 'streamline' ),
) );
add_theme_support( 'genesis-connect-woocommerce' );