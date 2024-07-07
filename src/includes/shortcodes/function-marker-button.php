<?php
/**
 * Fires when file is loaded to add shortcode
 *
 * @package GW2Embeds/Shortcodes
 */

GW2Emb_Shortcodes::add( 'MarkerButton' );

/**
 * Called by WordPress, if shortcode is used
 *
 * @param  array  $atts .
 * @param  string $content .
 * @param  string $tag .
 * @return string
 */
function gw2emb_MarkerButton_handler( $atts = array(), $content, $tag = 'error' ) {

	$filter = array(
		'marker' => '',
		'color'  => '',
		'mode'   => '',

	);

	require_once GW2Embeds::$path . 'includes/shortcodes/class-gw2emb-html-builder.php';

	// open new shortcode-instance.
	$shortcode = new GW2Emb_HTML_Builder( $atts, $tag, $filter );

	// cache the automatically created embedding code.
	$embedding = $shortcode->get_embedding();

	// check if armory-embed scripts are added.
	GW2Emb_Shortcodes::check_scripts(); // Only map-root should add the script.

	// hand over the embedding back to WordPress.
	return $embedding;
}
