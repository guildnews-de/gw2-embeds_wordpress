<?php
/**
 * Fires when file is loaded to add shortcode
 *
 * @package GW2Embeds/Shortcodes
 */

GW2Emb_Shortcodes::add( 'aura' );

/**
 * Called by WordPress, if shortcode is used
 *
 * @param  array  $atts .
 * @param  string $content .
 * @param  string $tag .
 * @return string
 */
function gw2emb_aura_handler( $atts = array(), $content, $tag = 'error' ) {

	$filter = array(
		'name'      => '',
		'notooltip' => '',
		'notext'    => '',
		'nolink'    => '',
		'noicon'    => '',
		'class'     => '',
		'size'      => '',
		'inline'    => '',
		'style'     => '',

	);

	require_once GW2Embeds::$path . 'includes/shortcodes/class-gw2emb-html-builder.php';

	// open new shortcode-instance.
	$shortcode = new GW2Emb_HTML_Builder( $atts, $tag, $filter );

	// cache the automatically created embedding code.
	$embedding = $shortcode->get_embedding();

	// check if armory-embed scripts are added.
	GW2Emb_Shortcodes::check_scripts();

	// hand over the embedding back to WordPress.
	return $embedding;
}
