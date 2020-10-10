<?php
/**
 *  Basic embedding contructor class
 */

class GW2_emb_Shortcode_Default
{
    // primary attributes
    protected $filter_array_prim = array(
      'id' => '',
      'text' => '',
      'blank' => '',
      'style' => '',
      'size' => '',
      );

    // secondary attributes
    protected $filter_array_sec = array(
      'none' => '',
      );

    // cache for basic shortcode information
    private $sc_tag;
    protected $id_array = [];
    private $output_array = [];

    // cache for final html-element
    private $dom;
    private $span;

    // error handling
    private $status = array(
      'ready' => false,
      'error' => false,
      'msg' => '[ GW2emb Error: ',
      );


    public function __construct($atts, $tag)
    {
        // save essential info
        $sc_prefix_length = strlen(GW2_emb_Snip::SC_PREFIX);
        $this->sc_tag = substr($tag, $sc_prefix_length);
        $this->id_array = explode(',', $atts['id']);

        // prepare empty html-element
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');

        // process input attributes
        $this->parse_attributes($atts);
    }


    /**
    *   unifies input attributes
    */
    protected function do_filter_array($raw_array, $filter_array)
    {
        // filter unsupported attributes
        $form_array = shortcode_atts($filter_array, $raw_array);

        // filter empty attributes
        $form_array = array_filter($form_array);

        // emliminate spaces between ids
        if (isset($form_array['id'])) {
            $form_array['id'] = preg_replace('/\s+/', '', $form_array['id']);
        }
        if (isset($form_array['traits'])) {
            $form_array['traits'] = preg_replace('/\s+/', '', $form_array['traits']);
        }

        return $form_array;
    }

    /**
    *   central function to get GW2-Armory html-attributes
    *   for the given shortcode attributes
    */
    protected function parse_attributes($atts)
    {
        // filter and format primary-attributes
        $atts_prim = $this->do_filter_array($atts, $this->filter_array_prim);

        // stop if no compatible primary-atts
        if (sizeof($atts) === 0) {
            $this->shortcode_error('attributes missing');
            return;
        }

        // filter and format secondary attributes
        $atts_sec = $this->do_filter_array($atts, $this->filter_array_sec);

        // process attributes
        $this->parse_primary_atts($atts_prim);
        $this->parse_secondary_atts($atts_sec);

        //
        $this->status['ready'] = true;
    }

    /**
    *   for easy attributes
    */
    protected function parse_primary_atts($atts)
    {
        // always given. no check needed
        $this->push_attribute('type', $this->sc_tag);

        // check for inline modifications
        $atts = $this->parse_inline_att($atts);

        // finds the fitting GW2-Armory attribute-tag for the shortcode atts
        foreach ($atts as $key => $value) {
            $success = false;
            $success = $this->push_attribute($key, $value);
            if ($success) {
                // eliminate source array-entry if successful
                unset($atts[$key]);
            }
        }

        if (sizeof($atts) > 0) {
            // stop if atts-array still not empty
            $this->shortcode_error('leftover attributes "'.sizeof($atts).'"');
        }
    }

    /**
    *   for the more work intensive variants
    */
    protected function parse_secondary_atts($atts)
    {
        // stop if empty
        if (sizeof($atts) === 0) {
          return;
        }

        // filter and process atts with special needs
        $atts = $this->parse_special_atts($atts);

        // cache main id array
        $ids = $this->id_array;

        /**
        *   tear apart the secondary id-string
        *   and combine each part with main-id on same positon
        */
        foreach ($atts as $att_tag => $value) {
            // segment for evtl. multi-view
            $segments = explode(';', $value);

            // combine each segment with its main-id
            foreach ($segments as $pos => $value) {
                if (isset($ids[$pos])) {
                    $this->push_attribute($att_tag, $value, $ids[$pos]);
                }
            }
        }
    }

    /**
    *   Inline view not supported nativley by armory embeddings
    *   this manually adds style attributes as work around
    */
    protected function parse_inline_att($atts)
    {
        if ($atts['style'] === 'inline') {
            $this->output_array['style'] = 'display: inline-block;';
            if (!isset($atts['size'])) {
                $atts['size'] = '20';
            }
        }
        unset($atts['style']);

        return $atts;
    }

    protected function parse_special_atts($atts)
    {
        return $atts;
    }

    /**
    *   Takes an processed attribute, finds fitting armory-embed attribute
    *   and adds it to the output-array
    */
    protected function push_attribute($att_tag, $value, $att_id=null)
    {
        if (isset($att_id)) {
            // process secondary attributes (witch need IDs)
            $attribute = GW2_emb_Snip::get_secondary_att($att_tag, $att_id);
        //echo '  ~~'.$att_tag.' ~ '.$att_id.'~~  ';
        } else {
            // process primary attributes
            $attribute = GW2_emb_Snip::get_primary_att($att_tag);
            //echo '  ~~'.$att_tag.'~~  ';
        }

        if (!isset($attribute)) {
            $this->shortcode_error('attributes incompatible "'.$att_tag.'"');
            return false;
        } elseif ($attribute === 1) {
            $this->shortcode_error('wrong id format "'.$att_id.'"');
            return false;
        } else {
            // add attribute => value to output_array
            $this->output_array[$attribute] = $value;
        }
        return true;
    }

    /**
    *   Takes every entry from output-array and
    *   adds it as attribute to the final html-element
    */
    protected function append_atts()
    {
        foreach ($this->output_array as $key => $value) {
            $this->span->setAttribute($key, $value);
        }
    }

    /**
    *   Triggerd by shortcode-handler
    *   puts the final html-element together
    */
    public function get_embedding()
    {
        if ($this->status['error'] === true) {
            return $this->status['msg'];
        } elseif ($this->status['ready'] === false) {
            return 'attributes not set';
        }

        $this->append_atts();
        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }


    protected function shortcode_error($string)
    {
        $this->status['msg'] .= '~'.$string.'~ ] ';
        $this->status['error'] = true;
    }
}
