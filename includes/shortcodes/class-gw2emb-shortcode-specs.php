<?php
/**
 * Specializations embedding contructor class
 * (i know. extremly exciting ;-)
 *
 * @package GW2Embeds/Shortcodes
 */

/** Specializaztion shortcode class */
class GW2Emb_Shortcode_Specs extends GW2Emb_Shortcode_Default {

	/**
	 * Primary attributes
	 *
	 * @var array
	 */
	protected $filter_array_prim = array(
		'id' => '',
	);

	/**
	 * Secondary attributes
	 *
	 * @var array
	 */
	protected $filter_array_sec = array(
		'traits' => '',
	);
}
