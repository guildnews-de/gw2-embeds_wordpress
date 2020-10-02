<?php
/**
 *  Basic embedding contructor class
 */

class GW2_emb_Shortcode_Default
{
    protected $filter_array_prim = array(
      'id' => '',
      'text' => '',
      'blank' => '',
      'style' => '',
      'size' => '',
      );

    protected $filter_array_sec = array(
      'none' => '',
      );

    protected $sc_tag;
    protected $id_array = [];
    protected $output_array = [];

    protected $status = array(
      'ready' => false,
      'error' => false,
      'msg' => '[ GW2emb Error: ',
      );

    protected $dom;
    protected $span;


    public function __construct($atts, $tag)
    {

        // save essential info
        $sc_prefix_length = strlen(GW2_emb_Snippets::SC_PREFIX);
        $this->sc_tag = substr($tag, $sc_prefix_length);
        $this->id_array = explode(',', $atts['id']);

        // prepare empty html-element
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');


        $this->parse_attributes($atts);
    }

    /**
    *   This prepares attributes before processing
    *     filter unsupported, eliminate empty options
    */
    protected function do_filter_array($raw_array, $filter_array)
    {
        // filter unsupported attributes
        $form_array = shortcode_atts($filter_array, $raw_array);

        // filter empty keys
        $form_array = array_filter($form_array);

        // emliminate spaces
        if (isset($form_array['id'])) {
            $form_array['id'] = preg_replace('/\s+/', '', $form_array['id']);
        }
        if (isset($form_array['traits'])) {
            $form_array['traits'] = preg_replace('/\s+/', '', $form_array['traits']);
        }

        return $form_array;
    }

    /**
    *   central function to turn the shortcode settings
    *   into GW2-Armory html-attributes
    */
    protected function parse_attributes($atts)
    {
        // filter and format attributes
        $atts_prim = $this->do_filter_array($atts, $this->filter_array_prim);
        if (sizeof($atts) === 0) {
            // stop if atts-array is empty
            $this->shortcode_error('attributes missing');
            return;
        }
        $atts_sec = $this->do_filter_array($atts, $this->filter_array_sec);

        // process attributes
        $this->parse_primary_atts($atts_prim);
        $this->parse_secondary_atts($atts_sec);


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
        if (sizeof($atts) === 0) {
          return;
        }

        $atts = $this->parse_special_atts($atts);

        $ids = $this->id_array;

        foreach ($atts as $att_tag => $value) {
            $fragments = explode(';', $value);

            foreach ($fragments as $pos => $value) {
                if (isset($ids[$pos])) {
                    $this->push_attribute($att_tag, $value, $ids[$pos]);
                }
            }
        }
    }

    protected function parse_inline_att($atts)
    {
        // evaluate inline-view additions
        if ($atts['style'] === 'inline') {
            $this->output_array['style'] = 'display: inline-block; vertical-align: bottom;';
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

    // add an attribut with its value to output_array
    protected function push_attribute($att_tag, $value, $att_id=null)
    {
        if (isset($att_id)) {
            // process secondary attributes (witch need IDs)
            $attribute = GW2_emb_Snippets::get_secondary_att($att_tag, $att_id);
        //echo '  ~~'.$att_tag.' ~ '.$att_id.'~~  ';
        } else {
            // process primary attributes
            $attribute = GW2_emb_Snippets::get_primary_att($att_tag);
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

    // add additonal attributes to html-element
    protected function append_atts()
    {
        foreach ($this->output_array as $key => $value) {
            $this->span->setAttribute($key, $value);
        }
    }

    // execute html-building functions and return element
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
