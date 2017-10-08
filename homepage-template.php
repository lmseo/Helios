<?php 
/*------------------------------
Template Name: HomePage
------------------------------*/ 

//during dev set to false. during Dist = true
$portArchDev = true;
//Set to true if critical local not recommended for dist
$criticalLocal = true;
//$isAsync uses loadcss asyn scritp true/false
$isAsync = false;
/*
*Inline crital CSS for first browser paint
*/
add_action('wp_head','lmseo_index_critical_css',1);
function lmseo_index_critical_css(){
	$path= 'bin/css/homepage/critical/styles.min.css.php';
	global $portArchDev;
	if($portArchDev){
		echo '<style type="text/css">';
		include $path;
		echo '</style>';
	}
}
/*
* Loads optimized CSS at the bottom of the page Asynch priority 20 is where 
add_action( 'wp_head',             'wp_enqueue_scripts',              1     );
add_action( 'wp_footer',           'wp_print_footer_scripts',         20    );
add_action( 'wp_head',             'wp_print_styles',                  8    );
add_action( 'wp_head',             'wp_print_head_scripts',            9    );

*/
add_action( 'wp_enqueue_scripts','lmseo_loadcss');
function lmseo_loadcss(){
    wp_enqueue_script('loadcss');
    wp_enqueue_script('onloadcss');
}
add_action('wp_footer','lmseo_index_load_css_asynchronously',20);
function lmseo_index_load_css_asynchronously(){
	global $portArchDev, $criticalLocal,$isAsync;
	if(!$portArchDev){
		if($isAsync){
		?>
			<script type='text/javascript'>
                       <?php
			if($criticalLocal){
				displayAsyncScriptCSS('/wp-content/themes/helios/bin/css/homepage/uncss/complete/style-v2.css', true);
			?>
	  		<?php
	  		}else{
	  			?>
				loadCSS('<?php echo "https://0475cc5f0513555876f0-36521bd99d04065c9ab75e027a3a3d9c.ssl.cf1.rackcdn.com/wp-content/themes/helios/bin/css/homepage/uncss/complete/style.css";?>');
				</script>
				<noscript><link href="https://0475cc5f0513555876f0-36521bd99d04065c9ab75e027a3a3d9c.ssl.cf1.rackcdn.com/wp-content/themes/helios/bin/css/homepage/uncss/complete/style.css" rel="stylesheet"></noscript>
		  		<?php
	  		}
	  	}else{
	  		wp_register_style(  'home-template', get_stylesheet_directory_uri(   ).'/bin/css/homepage/uncss/complete/style-v2.css' , '', '1' );
			wp_enqueue_style( 'home-template');
	  	}
	}else{
		?>
		<script type='text/javascript'>
                <?php
                    displayAsyncScriptCSS('/wp-content/themes/helios/bin/css/homepage/uncss/complete/style-v2.css', true);
		?>
		</script>
		<?php
	}
}
/*Enque <noscript> in the header*/
/*add_action(  'wp_head', 'lmseo_index_print_styles_nojavascript'   );
function lmseo_index_print_styles_nojavascript() {
	?>
	
	<?php
}*/
/**/

function displayAsyncScriptCSS($cssURL, $isCDN = false){
	//$cssDirectoryURI = $isCDN ? 'https://0475cc5f0513555876f0-36521bd99d04065c9ab75e027a3a3d9c.ssl.cf1.rackcdn.com/'. parse_url(get_stylesheet_directory_uri())[host] : get_stylesheet_directory_uri();
	//$cssDirectoryURI = $isCDN ? 'https://0475cc5f0513555876f0-36521bd99d04065c9ab75e027a3a3d9c.ssl.cf1.rackcdn.com/': get_stylesheet_directory_uri();
	?>
	var stylesheet = loadCSS('<?php echo $cssDirectoryURI.$cssURL;?>');
	onloadCSS( stylesheet, function() {
		$(window).load(function(){
			$(document).foundation();
		});
	});

	</script>
	
	<script type='text/javascript'>
            // jquery transit is used to handle the animation'.
            $('input').focusin(function(e) {
	        label = $('label[for='+$(this).get(0).id+']');
	            //console.log(label);
	        label.transition({x:'80px'},500,'ease').next().transition({x:'5px'},500, 'ease');
                //setTimeout needed for Chrome, for some reason there is no animation from left to right, the pen is immediately present. Slight delay to adding the animation class fixes it
	        setTimeout(function(){
	            label.next().addClass('move-pen');
	        },100);
	        
	          });
	          
	          $('input').focusout(function() {
	            label = $('label[for='+$(this).get(0).id+']');
	            label.transition({x:'0px'},500,'ease').next().transition({x:'-100px'},500, 'ease').removeClass('move-pen');
	          });
	</script>
	<noscript><link href="<?php echo $cssDirectoryURI . $cssURL;?>" rel="stylesheet"></noscript>
	<?php
}

//remove_action('enqueue_scripts');
/*
*Removes default CSS
*/
add_action(  'wp_enqueue_scripts', 'lmseo_index_print_styles'   );
function lmseo_index_print_styles() {
	global $portArchDev;
	if($portArchDev){
		/*Not in use*/
		wp_dequeue_style('lmseo');
		wp_deregister_style('lmseo');
		wp_dequeue_style('crayon');
		wp_dequeue_style('woocommerce-layout');
		wp_dequeue_style('woocommerce-general');
		wp_dequeue_style('woocommerce-smallscreen');
		wp_deregister_style('jetpack_css');
		wp_dequeue_style('jetpack_css');
		wp_dequeue_script('crayon_js');
		/*Bundled*/
		if( !is_super_admin() || !is_admin_bar_showing() || is_wp_login()){
			wp_deregister_script('jquery');
			wp_dequeue_script('jquery');
			wp_dequeue_script('jquery-migrate');
		}
		wp_dequeue_script('wc-add-to-cart');
		wp_dequeue_script('contact-form-7');
		wp_dequeue_style('contact-form-7');
		wp_dequeue_script('html5shiv');
		wp_dequeue_script('modernizr');
		wp_deregister_script('jquery-blockui');
		wp_dequeue_script('jquery-blockui');
		wp_dequeue_script('wc-cart-fragments');
		wp_dequeue_script('blueimp_helper');
		wp_dequeue_script('blueimp');
		wp_dequeue_script('transit');
		wp_dequeue_script('scrollto');
		wp_dequeue_script('foundation');
		wp_dequeue_script('foundation_app');
		wp_register_script( 'custom-waypoint',get_stylesheet_directory_uri(  ) . '/helios/js/custom/custom.waypoints.js',array( ), '1', true );
		//wp_deregister_script('insert_footer_js');
		//wp_dequeue_script('insert_footer_js');
		//wp_deregister_script('enqueue_scripts');
		//wp_dequeue_script('enqueue_scripts');
		
		//foreach( array( 'wp_enqueue_scripts', 'login_enqueue_scripts' ) as $a ) { add_action( $a, array($this,'enqueue_scripts'), 100 ); }


		
		//wp_enqueue_script('jquery-easing');
		//wp_enqueue_script('jquery-circularcontentcarousel');
		//wp_enqueue_script('jquery-mousewheel');
		//wp_register_style(  'home-template', get_stylesheet_directory_uri(   ).'/bin/css/homepage/style.css' , '', '1' );
		//wp_enqueue_style( 'home-template');
	}
}
/** Add Main JS to website */
add_action( 'wp_enqueue_scripts','MainJS');
function MainJS(){
	/*In Use*/
    global $portArchDev;
	if($portArchDev){
            wp_enqueue_script('index-main');
        }
}
//disable or remove wp-embed.js from WordPress
    function lmseo_deregister_scripts(){
 wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'lmseo_deregister_scripts' );
/** Runs Foundation on the website */
//add_action( 'wp_footer','foundationApp',20 );
function foundationApp(){
	?>
	<script type='text/javascript'>
		$(window).load(function(){
			$(document).foundation();
		});
		</script>
	<?php
}

/*
* Force the full width layout layout on the Portfolio page 
*/
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

/*
*remove wrappers for header and inner
*/
remove_theme_support('genesis-structural-wraps',array( 'header','inner'));

/*
* add body class when full width slider is disable add_filter( 'body_class', 'zp_body_class' );
*/
add_filter( 'body_class', 'zp_body_class' );
function zp_body_class( $classes ) {
global $post;
	
$enable = get_post_meta( $post->ID, 'zp_fullwidth_slider_value', true);

if( $enable == 'false' ){
	$classes[] = 'zp_boxed_home';
}
	return $classes;
}

remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_homepage_template' );
function zp_homepage_template() {
?>
<div id="home-wrap">
<?php
	if(  have_posts( ) ) {											
 		while (  have_posts(  )  ) {
			the_post(  ); 
			
			do_shortcode( the_content() );
		}
	}
?>
</div>
<?php
}
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
	require_once ( get_stylesheet_directory() . '/lib/partials/recent-posts.php' );
	require_once ( get_stylesheet_directory() . '/lib/partials/services.php' );
	
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