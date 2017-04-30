<?php

/**
 * ADMIN SCRIPTS AND STYLES
 */
add_action( 'admin_enqueue_scripts', 'vaso_admin_scripts' );
function vaso_admin_scripts()
{
	wp_enqueue_style( 'vaso-admin-style', VASO_CITA_PLUGIN_URL . '/assets/css/admin.css' );
}


// add 'views' column to admin posts list
add_filter( 'manage_posts_columns', 'vaso_cita_add_post_views_columns' );
function vaso_cita_add_post_views_columns( $columns )
{
	$columns['views'] = __( 'Views', 'vaso-cita' );
	return $columns;
}

// populate the 'views' column
add_action( 'manage_posts_custom_column', 'vaso_cita_add_post_views_columns_data', 10, 2 );
function vaso_cita_add_post_views_columns_data( $column, $post_id )
{
	if ( $column === 'views' ) {
		$views = get_post_meta( $post_id, '_post_view_count', true );
		$views = $views ? $views : 0;
		echo $views;
	}
}

// make 'views' column sortable
add_filter( 'manage_edit-post_sortable_columns', 'vaso_cita_add_sortable_views_column' );
function vaso_cita_add_sortable_views_column( $columns )
{
	$columns['views'] = 'views';
	return $columns;
}

// order by 'views' column
add_action( 'pre_get_posts', 'vaso_cita_views_column_orderby' );
function vaso_cita_views_column_orderby( $query )
{
	if ( ! is_admin() ) {
		return;
	}

	$orderby = $query->get( 'orderby' );

	if ( 'views' === $orderby ) {
		$query->set( 'meta_key', '_post_view_count' );
		$query->set( 'orderby', 'meta_value_num' );
	}
}