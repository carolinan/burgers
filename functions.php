<?php
/**
 * Burgers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Burgers
 * @since 1.0.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function burgers_theme_support() {
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Burgers, use a find and replace
	 * to change 'burgers' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'burgers' );

	// Add support for full and wide align.
	add_theme_support( 'align-wide' );

	// Block Editor Palette.
	$editor_color_palette = array(
		array(
			'name'  => __( 'Accent Color', 'burgers' ),
			'slug'  => 'accent',
			'color' => '#333',
		),
		array(
			'name'  => __( 'Primary', 'burgers' ),
			'slug'  => 'primary',
			'color' => '#fff',
		),
	);

	add_theme_support( 'editor-color-palette', $editor_color_palette );
}

add_action( 'after_setup_theme', 'burgers_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function burgers_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'burgers-style', get_stylesheet_uri(), array(), $theme_version );
	wp_style_add_data( 'burgers-style', 'rtl', 'replace' );

}
add_action( 'wp_enqueue_scripts', 'burgers_register_styles' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function burgers_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'burgers_skip_link_focus_fix' );

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function burgers_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . esc_html__( 'Skip to the content', 'burgers' ) . '</a>';
}

add_action( 'wp_body_open', 'burgers_skip_link', 5 );
