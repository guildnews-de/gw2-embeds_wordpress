<?php
/**
 * Main Shortcodes Management class
 *
 * @package GW2Embeds/Shortcodes
 */

/** Shortcode class */
class GW2Emb_Shortcodes {
	/**
	 * Shortcode prefix
	 *
	 * @var string
	 */
	const PREFIX = 'gw2emb_';
	/**
	 * HTML dataset prefix
	 *
	 * @var string
	 */
	const DATASET = 'data-gw2-';

		/**
	 * HTML dataset prefix
	 *
	 * @var string
	 */
	const MAP_DATASET = 'data-gw2map-';

	/**
	 * Static buffer for shortcodes
	 * Filled through add-Method during load of individual shortcode files.
	 *
	 * @var array of sc-tag => sc-tag_handler pairs.
	 */
	private static $shortcodes = array();

	/**
	 * Adds shortcode-tag to array
	 *
	 * @param  string $tag to be added.
	 * @return void
	 */
	public static function add( $tag ) {
		self::$shortcodes[ $tag ] = $tag . '_handler';
	}

	/**
	 * Register shortcodes in WordPress
	 *
	 * @return void
	 */
	public static function register() {
		foreach ( self::$shortcodes as $tag => $callback ) {

			add_shortcode( self::PREFIX . $tag, self::PREFIX . $callback );
		}
	}

	/**
	 * Check if embed scripts are added.
	 *
	 * @return void
	 */
	public static function check_scripts() {
		wp_enqueue_script( 'gw2-embeds.js', GW2Embeds::$url . 'public/gw2-embeds/gw2-embeds.js', null, '0.3.1', true );
	}

	/**
	 * Check if map embed scripts are added.
	 *
	 * @return void
	 */
	public static function check_map_scripts() {
		wp_enqueue_script( 'gw2-map.embeds.js', GW2Embeds::$url . 'public/gw2-map-embeds/gw2-map-embeds.js', null, '1.1.0', true );

	}
}
