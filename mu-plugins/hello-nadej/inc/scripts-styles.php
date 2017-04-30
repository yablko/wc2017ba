<?php

/**
 * ADMIN CSS
 */
add_action( 'admin_enqueue_scripts', 'hello_nadej_admin_css' );
function hello_nadej_admin_css() {
	wp_enqueue_style( 'nadej-css', HELLO_NADEJ_PLUGIN_URL . '/assets/css/admin.css' );
}