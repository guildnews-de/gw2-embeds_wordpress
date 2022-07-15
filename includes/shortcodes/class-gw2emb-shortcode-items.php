<?php
/**
 * Item embedding contructor class
 * has some additions regarding item types and configurations
 *
 * @package GW2Embeds/Shortcodes
 */

/** Item shortcode class */
class GW2Emb_Shortcode_Items extends GW2Emb_Shortcode_Default {

	/**
	 * Secondary attributes
	 *
	 * @var array
	 */
	protected $filter_array_sec = array(
		'skin'      => '',
		'stat'      => '',
		'infusions' => '',
		'upgrades'  => '',
	);

	/**
	 * Item-upgrades need special handling
	 * because of possible stacked upgrades
	 * ("upgrade-count" in original armory-embeds)
	 *
	 * @param  array $atts .
	 * @return array
	 */
	protected function parse_special_atts( $atts ) {
		if ( isset( $atts['upgrades'] ) ) {
			// segment for evtl. multi-view.
			$upgr_array = explode( ';', $atts['upgrades'] );

			foreach ( $upgr_array as $pos1 => $value ) {
				// filter and process upgrade-count.
				$upgr_str = $this->filter_upgrade_count( $value, $pos1 );

				$this->push_attribute( 'upgrade', $upgr_str, $this->id_array[ $pos1 ] );
			}
			unset( $atts['upgrades'] );
		}
		return $atts;
	}

	/**
	 * Tears apart the upgrades-string to get upgrade-count information
	 * returns usual upgrades-string without count-additions
	 *
	 * @param  string $upgr_value .
	 * @param  string $id_pos .
	 * @return string
	 */
	protected function filter_upgrade_count( $upgr_value, $id_pos ) {
		// separate every upgrade-id, if count-indicator "+" is found.
		if ( strpbrk( $upgr_value, '+' ) ) {
			$fragments = explode( ',', $upgr_value );

			/**
			*  If an upgrade-id includes "+" splits it in two
			*  pushes it as count-attribute and eliminates +count from original string
			*/
			foreach ( $fragments as $pos2 => $value ) {
				if ( strpbrk( $value, '+' ) ) {
					$count     = explode( '+', $value );
					$count_str = '{"' . $count['0'] . '": ' . $count['1'] . '}';
					$count_id  = $this->id_array[ $id_pos ];

					$this->push_attribute( 'count', $count_str, $count_id );
					$fragments[ $pos2 ] = $count['0'];
				}
			}
			$upgr_value = implode( ',', $fragments );
		}
		return $upgr_value;
	}
}
