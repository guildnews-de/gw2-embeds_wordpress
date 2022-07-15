<?php
/**
 * Snippets strings an string-builders
 *
 * @package GW2Embeds/Snip
 */

/** Snippet-Class */
class GW2Emb_Snip {

	const PLUGIN_PREFIX = 'gw2_embeddings_';
	const SC_PREFIX     = 'gw2emb_';
	const ATTS_PREFIX   = 'data-armory-';

	const PRIMARY = array(
		'type'  => 'embed',
		'id'    => 'ids',
		'text'  => 'inline-text',
		'size'  => 'size',
		'blank' => 'blank-text',
	);

	const SECONDARY = array(
		'traits'    => '-traits',
		'skin'      => '-skin',
		'stat'      => '-stat',
		'infusions' => '-infusions',
		'upgrade'   => '-upgrades',
		'count'     => '-upgrade-count',
	);

	/**
	 * Plugin Path
	 *
	 * @var string
	 */
	public static $plugin_path;
	/**
	 * Plugin URL
	 *
	 * @var string
	 */
	public static $plugin_url;

	/**
	 * Add attribute prefix
	 *
	 * @param  string $str to be prefixed.
	 * @return string
	 */
	public static function add_atts_prefix( $str ) {
		return self::ATTS_PREFIX . $str;
	}

	/**
	 * Add shortcode prefix
	 *
	 * @param  string $str to be prefixed.
	 * @return string
	 */
	public static function add_sc_prefix( $str ) {
		return self::SC_PREFIX . $str;
	}

	/**
	 * Add plugin prefix
	 *
	 * @param  string $str to be prefixed.
	 * @return string
	 */
	public static function add_plugin_prefix( $str ) {
		return self::PLUGIN_PREFIX . $str;
	}

	/**
	 * Request attribute string
	 *
	 * @param  string $type of attribute.
	 * @return string
	 */
	public static function get_primary_att( $type ) {
		if ( isset( self::PRIMARY[ $type ] ) ) {
			$snippet = self::ATTS_PREFIX . self::PRIMARY[ $type ];
			return $snippet;
		}
	}

	/**
	 * Request attribute string
	 *
	 * @param  string $type of attribute.
	 * @param  string $id of attribute.
	 * @return string
	 */
	public static function get_secondary_att( $type, $id ) {
		if ( isset( self::SECONDARY[ $type ] ) ) {
			if ( ctype_digit( $id ) ) {
				$snippet = self::ATTS_PREFIX . $id . self::SECONDARY[ $type ];
				return $snippet;
			} else {
				return 1;
			}
		}
	}

	/**
	 * Require default shortcode class
	 *
	 * @return void
	 */
	public static function require_sc_default() {
		require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_default.php';
	}

	/**
	 * Require item shortcode class
	 *
	 * @return void
	 */
	public static function require_sc_items() {
		self::require_sc_default();
		require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_items.php';
	}

	/**
	 * Require specialization shortcode class
	 *
	 * @return void
	 */
	public static function require_sc_specs() {
		self::require_sc_default();
		require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_specs.php';
	}

}
