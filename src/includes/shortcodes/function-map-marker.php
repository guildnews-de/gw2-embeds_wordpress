<?php
/**
 * Fires when file is loaded to add shortcode
 *
 * @package GW2Embeds/Shortcodes
 */

GW2Emb_Shortcodes::add( 'mapMarker' );

/**
 * Called by WordPress, if shortcode is used
 *
 * @param  array  $atts .
 * @param  string $content .
 * @param  string $tag .
 * @return string
 */
function gw2emb_mapMarker_handler( $atts = array(), $content, $tag ) {

	$filter = array(
		'marker' => '',
		'color'  => '',
		'mode'   => '',

	);

	require_once GW2Embeds::$path . 'includes/shortcodes/class-gw2emb-maphtml-builder.php';

	// open new shortcode-instance.
	$shortcode = new GW2Emb_MapHTML_Builder( $atts, $tag, $filter );

	// cache the automatically created embedding code.
	$embedding = $shortcode->get_embedding();

	// check if armory-embed scripts are added.
	// GW2Emb_Shortcodes::check_map_scripts(); //Only map-root should add the script.

	// hand over the embedding back to WordPress.
	return $embedding;
}
