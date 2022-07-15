<?php
/**
 * Mein Shortcodes Management class
 *
 * @package GW2Embeds/Shortcodes
 */

/** Shortcode class */
class GW2Emb_Shortcodes {

	/**
	 * Static buffer for shortcodes
	 *
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
		$prefix     = GW2Emb_Snip::SC_PREFIX;
		$shortcodes = self::$shortcodes;

		foreach ( $shortcodes as $tag => $callback ) {

			add_shortcode( $prefix . $tag, $prefix . $callback );
		}
	}

	/**
	 * Check if embed scripts are added.
	 *
	 * @return void
	 */
	public static function check_scripts() {
		wp_enqueue_script( 'GW2arm-locale.js', GW2Emb_Snip::$plugin_url . 'languages/js/gw2arm_locale.js', null, '1.0', true );
		wp_enqueue_script( 'armory-embeds.js', 'https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js', null, '0.x', true );

	}
}
