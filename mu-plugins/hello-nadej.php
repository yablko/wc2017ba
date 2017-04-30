<?php

/*
	REKLAMA:
	https://www.facebook.com/yablko.smrdi
	https://www.youtube.com/yablko
	http://yablko.sk
*/

/*
Plugin Name: Hello Nádej
Plugin URI: https://www.facebook.com/yablko.smrdi
Description: Baterky má vypálené
Author: Vašislav
Version: 0.01
Author URI: http://yablko.sk
*/

define( 'HELLO_NADEJ_PLUGIN', __FILE__ );
define( 'HELLO_NADEJ_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) . '/hello-nadej');
define( 'HELLO_NADEJ_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) . '/hello-nadej');


/**
 * FUNCTIONS
 */
require_once HELLO_NADEJ_PLUGIN_DIR . '/inc/functions.php';


/**
 * ASSETS, SCRIPTS, STYLES
 */
require_once HELLO_NADEJ_PLUGIN_DIR . '/inc/scripts-styles.php';


/**
 * INIT NADEJ
 */
add_action( 'admin_notices', 'hello_nadej' );
function hello_nadej()
{
	$chosen = hello_nadej_get_lyric();
	echo "<div id='nadej'>
		<h1>$chosen</h1>
	</div>";
}