<?php

/*
	REKLAMA:
	https://www.facebook.com/yablko.smrdi
	https://www.youtube.com/yablko
	http://yablko.sk
*/

/*
Plugin Name: Vašo číta
Plugin URI: https://www.facebook.com/yablko.smrdi/
Description: Všetko krásne stíchlo
Author: Vašislav
Version: 0.01
Author URI: http://yablko.sk
*/

define( 'VASO_CITA_PLUGIN', __FILE__ );
define( 'VASO_CITA_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ));
define( 'VASO_CITA_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ));


/**
 * IN ADMIN
 * - do zoznamu prispevkov v admine to prida stlpec, ktory zobrazuje pocet otvoreni clanku
 * - netestoval som to na postoch, ktore nemaju ani jeden view, takze ak to robi problemy, otvor si kazdy post zopar krat:)
 */
if ( is_admin() ) {
	require_once VASO_CITA_PLUGIN_DIR . '/inc/admin.php';
}


/**
 * WIDGET
 * - do widgetov pribudne 'Vaso cita', ktory mozes prihodit do sidebaru
 * - potom sa v nom zobrazi zoznam prispevkov od najcitanejsieho
 */
require_once VASO_CITA_PLUGIN_DIR . '/inc/widget.php';


/**
 * INIT CITADLO
 */
add_action( 'the_content', 'vaso_cita_count' );
function vaso_cita_count( $content )
{
	// ak sa zobrazuje jeden konkretne clanok, najdeme kolko krat bol zobrazeny
	// zvysime tu hodnotu o jedna, ulozime novu hodnotu
	// hodnota sa uklada ako "meta value", moja vlastna hodnota, ktora sa prilepi k postu
	// ked pred post_view_count das podtrznik, nezobrazi sa v Edite pod Custom Fields
	// preto som stlpec nazval _post_view_count, aby sa nedal editovat priamo
	if ( is_single() )
	{
		$views = (int) get_post_field('_post_view_count') ?: 0;
		$views++;

		update_post_meta( get_the_ID(), '_post_view_count', $views );
	}

	return $content;
}