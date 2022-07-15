<?php
/**
 *  HTML Builder for default shortcodes
 *
 * @package GW2Embeds/Shortcodes
 */

/** Default shortcodes class */
class GW2Emb_Shortcode_Default {

	/**
	 * Primary attributes
	 *
	 * @var array
	 */
	protected $filter_array_prim = array(
		'id'    => '',
		'text'  => '',
		'blank' => '',
		'style' => '',
		'size'  => '',
	);

	/**
	 * Secondary attributes
	 *
	 * @var array
	 */
	protected $filter_array_sec = array(
		'none' => '',
	);

	/**
	 * Shortcode tag
	 *
	 * @var string
	 */
	private $sc_tag;
	/**
	 * API IDs
	 *
	 * @var array
	 */
	protected $id_array = array();
	/**
	 * Key => value for html element
	 *
	 * @var array
	 */
	private $output_array = array();

	/**
	 * Shortcode html dom
	 *
	 * @var DOMDocument
	 */
	private $dom;
	/**
	 * Shortcode span element
	 *
	 * @var DOMElement
	 */
	private $span;

	/**
	 * Error handling
	 *
	 * @var array
	 */
	private $status = array(
		'ready' => false,
		'error' => false,
		'msg'   => '[ GW2emb Error: ',
	);

	/**
	 * Setup variables
	 *
	 * @param array  $atts shortcode parameters.
	 * @param  string $tag of shortcode.
	 */
	public function __construct( $atts, $tag ) {
		// save essential info.
		$sc_prefix_length = strlen( GW2Emb_Snip::SC_PREFIX );
		$this->sc_tag     = substr( $tag, $sc_prefix_length );
		$this->id_array   = explode( ',', $atts['id'] );

		// prepare empty html-element.
		$this->dom  = new DOMDocument();
		$this->span = $this->dom->createElement( 'span' );

		// process input attributes.
		$this->parse_attributes( $atts );
	}


	/**
	 * Prepare attribute array
	 *
	 * @param  array $raw_array of attributes.
	 * @param  array $filter_array to be checked against.
	 * @return array
	 */
	protected function do_filter_array( $raw_array, $filter_array ) {
		// filter unsupported attributes.
		$form_array = shortcode_atts( $filter_array, $raw_array );

		// filter empty attributes.
		$form_array = array_filter( $form_array );

		// emliminate spaces between ids.
		if ( isset( $form_array['id'] ) ) {
			$form_array['id'] = preg_replace( '/\s+/', '', $form_array['id'] );
		}
		if ( isset( $form_array['traits'] ) ) {
			$form_array['traits'] = preg_replace( '/\s+/', '', $form_array['traits'] );
		}

		return $form_array;
	}

	/**
	 * Central function to get GW2-Armory html-attributes
	 * for the given shortcode attributes
	 *
	 * @param array $atts to be parsed.
	 * @return void
	 */
	protected function parse_attributes( $atts ) {
		// filter and format primary-attributes.
		$atts_prim = $this->do_filter_array( $atts, $this->filter_array_prim );

		// stop if no compatible primary-atts.
		if ( count( $atts ) === 0 ) {
			$this->shortcode_error( 'attributes missing' );
			return;
		}

		// filter and format secondary attributes.
		$atts_sec = $this->do_filter_array( $atts, $this->filter_array_sec );

		// process attributes.
		$this->parse_primary_atts( $atts_prim );
		$this->parse_secondary_atts( $atts_sec );

				$this->status['ready'] = true;
	}

	/**
	 * Ease attributes
	 *
	 * @param  array $atts .
	 * @return void
	 */
	protected function parse_primary_atts( $atts ) {
		// always given. no check needed.
		$this->push_attribute( 'type', $this->sc_tag );

		// check for inline modifications.
		$atts = $this->parse_inline_att( $atts );

		// finds the fitting GW2-Armory attribute-tag for the shortcode atts.
		foreach ( $atts as $key => $value ) {
			$success = false;
			$success = $this->push_attribute( $key, $value );
			if ( $success ) {
				// eliminate source array-entry if successful.
				unset( $atts[ $key ] );
			}
		}

		if ( count( $atts ) > 0 ) {
			// stop if atts-array still not empty.
			$this->shortcode_error( 'leftover attributes "' . count( $atts ) . '"' );
		}
	}

	/**
	 * Complicated attributes
	 *
	 * @param  array $atts .
	 * @return void
	 */
	protected function parse_secondary_atts( $atts ) {
		// stop if empty.
		if ( count( $atts ) === 0 ) {
			return;
		}

		// filter and process atts with special needs.
		$atts = $this->parse_special_atts( $atts );

		// cache main id array.
		$ids = $this->id_array;

		/**
		*   Tear apart the secondary id-string
		*   and combine each part with main-id on same positon
		*/
		foreach ( $atts as $att_tag => $value ) {
			// segment for evtl. multi-view.
			$segments = explode( ';', $value );

			// combine each segment with its main-id.
			foreach ( $segments as $pos => $value ) {
				if ( isset( $ids[ $pos ] ) ) {
					$this->push_attribute( $att_tag, $value, $ids[ $pos ] );
				}
			}
		}
	}

	/**
	 * Inline view not supported nativley by armory embeddings
	 * this manually adds style attributes as work around
	 *
	 * @param  array $atts .
	 * @return array
	 */
	protected function parse_inline_att( $atts ) {
		if ( 'inline' === $atts['style'] ) {
			$this->output_array['style'] = 'display: inline-block;';
			if ( ! isset( $atts['size'] ) ) {
				$atts['size'] = '20';
			}
		}
		unset( $atts['style'] );

		return $atts;
	}

	/**
	 * Empty template function
	 *
	 * @param  array $atts .
	 * @return array
	 */
	protected function parse_special_atts( $atts ) {
		return $atts;
	}

	/**
	 * Takes an processed attribute, finds fitting armory-embed attribute
	 * and adds it to the output-array
	 *
	 * @param  string $att_tag .
	 * @param  string $value .
	 * @param  string $att_id .
	 * @return boolean
	 */
	protected function push_attribute( $att_tag, $value, $att_id = null ) {
		if ( isset( $att_id ) ) {
			// process secondary attributes (witch need IDs).
			$attribute = GW2Emb_Snip::get_secondary_att( $att_tag, $att_id );
			// echo '  ~~'.$att_tag.' ~ '.$att_id.'~~  ';.
		} else {
			// process primary attributes.
			$attribute = GW2Emb_Snip::get_primary_att( $att_tag );
			// echo '  ~~'.$att_tag.'~~  ';.
		}

		if ( ! isset( $attribute ) ) {
			$this->shortcode_error( 'attributes incompatible "' . $att_tag . '"' );
			return false;
		} elseif ( 1 === $attribute ) {
			$this->shortcode_error( 'wrong id format "' . $att_id . '"' );
			return false;
		} else {
			// add attribute => value to output_array.
			$this->output_array[ $attribute ] = $value;
		}
		return true;
	}

	/**
	 *   Takes every entry from output-array and
	 *   adds it as attribute to the final html-element
	 */
	protected function append_atts() {
		foreach ( $this->output_array as $key => $value ) {
			$this->span->setAttribute( $key, $value );
		}
	}

	/**
	 *   Triggerd by shortcode-handler
	 *   puts the final html-element together
	 */
	public function get_embedding() {
		if ( true === $this->status['error'] ) {
			return $this->status['msg'];
		} elseif ( false === $this->status['ready'] ) {
			return 'attributes not set';
		}

		$this->append_atts();
		$this->dom->appendChild( $this->span );
		return $this->dom->saveHTML();
	}

	/**
	 * Set error text
	 *
	 * @param  string $str .
	 * @return void
	 */
	protected function shortcode_error( $str ) {
		$this->status['msg']  .= '~' . $str . '~ ] ';
		$this->status['error'] = true;
	}
}
