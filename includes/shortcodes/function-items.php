<?php
/**
 * Fires when file is loaded to add shortcode
 *
 * @package GW2Embeds/Shortcodes
 */

GW2_emb_Shortcodes::add( 'items' );

/**
 * Called by WordPress, if shortcode is used
 *
 * @param  array  $atts .
 * @param  string $content .
 * @param  string $tag .
 * @return string
 */
function gw2emb_items_handler( $atts = array(), $content, $tag ) {
	// check dependencies.
	GW2Emb_Snip::require_sc_items();

	// open new shortcode-instance.
	$shortcode = new GW2_emb_Shortcode_Items( $atts, $tag );

	// cache the automatically created embedding code.
	$embedding = $shortcode->get_embedding();

	// check if armory-embed scripts are added.
	GW2_emb_Shortcodes::check_scripts();

	// hand over the embedding back to WordPress.
	return $embedding;
}
