<?php
/**
 *  HTML Builder for default shortcodes
 *
 * @package GW2Embeds/Shortcodes
 */

/** Default shortcodes class */
class GW2Emb_MapHTML_Builder {

	/**
	 * Primary attributes
	 *
	 * @var array
	 */
	protected $filter_array = array(
		'error' => 'filter empty',
	);

	/**
	 * Shortcode tag
	 *
	 * @var string
	 */
	private $sc_tag;
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
	 * @param string $tag of shortcode.
	 * @param array  $filter .
	 */
	public function __construct( $atts, $tag, $filter ) {
		// save essential info.
		$sc_prefix_length   = strlen( GW2Emb_Shortcodes::PREFIX );
		$this->sc_tag       = substr( $tag, $sc_prefix_length );
		$this->filter_array = $filter;

		// prepare empty html-element.
		$this->dom  = new DOMDocument();
		$this->span = $this->dom->createElement( 'span' );

		// process input attributes.
		$this->parse_attributes( $atts );
	}

	/**
	 * Central function to get html-attributes
	 * for the given shortcode attributes
	 *
	 * @param array $atts to be parsed.
	 * @return void
	 */
	protected function parse_attributes( $atts ) {
		// filter unsupported an empty attributes.
		$form_array = array_filter( shortcode_atts( $this->filter_array, $atts ) );

		// stop if no compatible primary-atts.
		if ( count( $atts ) === 0 ) {
			$this->shortcode_error( 'attributes missing' );
			return;
		}

		$this->push_attribute( 'mapEmbed', $this->sc_tag );

		// finds the fitting attribute-tag for the shortcode atts.
		foreach ( $form_array as $key => $value ) {
			$success = false;
			$success = $this->push_attribute( $key, $value );
			if ( $success ) {
				// eliminate source array-entry if successful.
				unset( $form_array[ $key ] );
			}
		}

		if ( count( $form_array ) > 0 ) {
			// stop if atts-array still not empty.
			$this->shortcode_error( 'leftover attributes "' . count( $form_array ) . '"' );
		}
		$this->status['ready'] = true;
	}

	/**
	 * Takes an processed attribute, finds fitting armory-embed attribute
	 * and adds it to the output-array
	 *
	 * @param  string $att_tag .
	 * @param  string $value .
	 * @return boolean
	 */
	protected function push_attribute( $att_tag, $value ) {
		$attribute = GW2Emb_Shortcodes::MAP_DATASET . $att_tag;

		// add attribute => value to output_array.
		$this->output_array[ $attribute ] = $value;

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

		if ( 'mapRoot' === $this->sc_tag ) {
			$this->span->setAttribute( 'id', strtr( 'gw2$tag', array( '$tag' => $this->sc_tag ) ) );
		} else {
			$this->span->setAttribute( 'class', strtr( 'gw2$tag', array( '$tag' => $this->sc_tag ) ) );
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
