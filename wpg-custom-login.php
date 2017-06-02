<?php
/**
 * Plugin Name:         WPG Custom Login
 * Plugin URI:          https://github.com/wp-globalis-tools/wpg-custom-login
 * Description:         Customize your wp-login.php page with project logo and title
 * Author:              Pierre Dargham, Globalis Media Systems
 * Author URI:          https://www.globalis-ms.com/
 * License:             GPL2
 *
 * Version:             0.3.0
 * Requires at least:   4.0.0
 * Tested up to:        4.7.8
 */

namespace Globalis\WP\CustomLogin;

if(!defined('ABSPATH')) {
	die('-1');
}

add_action('login_head', __NAMESPACE__.'\\custom_login_css', 10);
add_filter('login_headerurl', __NAMESPACE__.'\\custom_login_header_url', 10, 1);
add_filter('login_headertitle', __NAMESPACE__.'\\custom_login_header_title', 10, 1);

/**
 * Custom Login CSS
 */
function custom_login_css() {
	$logo_url  = get_stylesheet_directory_uri() . '/logo.png';
	$logo_path = get_stylesheet_directory() . '/logo.png';

	if(!file_exists($logo_path)) {
		$logo_url  = get_stylesheet_directory_uri() . '/logo.jpg';
		$logo_path = get_stylesheet_directory() . '/logo.jpg';
	}
	if(file_exists($logo_path)) {
		ob_start();
		?>
		<style type="text/css" media="screen">
			.login h1 {
				background-image: url(<?= $logo_url ?>);
				background-position: center top;
				background-repeat: no-repeat;
				background-size: contain;
				width: 100%;
				height: 100%;
			}
			.login h1 a {
				background-image: none;
				display: block;
				width: 100%;
				min-height: 100px;
				}
			.login .message {
				margin-top: 20px;
			}
		</style>
		<?php
	}

	echo apply_filters('wpg_custom_login_css', ob_get_clean());
}

/**
 * Custom Login Header URL
 */
function custom_login_header_url($url) {
	return esc_url(home_url('/'));
}

/**
 * Custom Login Header Title
 */
function custom_login_header_title($title) {
	return get_bloginfo('name');
}
