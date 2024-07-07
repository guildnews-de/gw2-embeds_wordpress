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
		wp_enqueue_script(
			'gw2embeds.js',
			GW2Embeds::$url . 'public/gw2embeds/index.js',
			null,
			'2.0',
			true
		);
	}
}
