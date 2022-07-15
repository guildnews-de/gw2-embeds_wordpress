<?php
/**
 * Main Plugin Bootstrap
 *
 * Load available shortcodes.
 * define hooks.
 *
 * @package GW2Embeds
 */

/** Main Plugin class */
class GW2Emb_Main {

	/**
	 * Constructor
	 *
	 * @param  string $plugin_file path string.
	 */
	public function __construct( $plugin_file ) {
		GW2Emb_Snip::$plugin_path = plugin_dir_path( $plugin_file );
		GW2Emb_Snip::$plugin_url  = plugin_dir_url( $plugin_file );

		$this->load_includes();
		$this->define_common_hooks();
	}

	/**
	 * Include essential files and load shortcodes.
	 *
	 * @return void
	 */
	private function load_includes() {

		// load shortcode management class.
		require_once GW2Emb_Snip::$plugin_path . 'includes/class-gw2emb-shortcodes.php';

		// load available shortcodes.
		require_once GW2Emb_Snip::$plugin_path . 'includes/shortcodes/0-include-shortcodes.php';
	}

	/**
	 * Register available shortcodes
	 *
	 * @return void
	 */
	private function define_common_hooks() {

		add_action( 'init', array( 'GW2Emb_Shortcodes', 'register' ) );
	}
}
