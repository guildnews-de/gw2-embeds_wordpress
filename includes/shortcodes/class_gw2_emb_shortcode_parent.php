<?php

class GW2_emb_Shortcode_Parent
{
    protected $filter_array = array(
      'id' => '',
      'text' => '',
      'style' => '',
      'size' => '',
      'blank' => '',
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
        $this->sc_tag = $tag;
        $this->id_array = explode($atts['id']);

        // prepare empty html-element
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');

        // filter and format attributes
        $atts = $this->do_filter_array($atts);
        if (sizeof($atts) === 0) {
            // stop if atts-array is empty
            shortcode_error('attributes missing');
            return;
        }

        // process attributes
        $this->parse_attributes($atts);
    }

    // filter unsupported or empty keys and beautify
    protected function do_filter_array($raw_array)
    {
        // filter unsupported attributes
        $form_array = shortcode_atts($this->filter_array, $raw_array);

        // filter empty keys
        $form_array = array_filter($form_array);

        return $form_array;
    }

    protected function parse_attributes($atts)
    {
        $this->status['ready'] = true;
    }

    private function parse_secondary_att($att_tag, $value_str)
    {
        $items = explode(';', $value_str);

        foreach ($this->id_array as $pos => $id) {
            if (isset($items[$pos])) {
                push_item_adds($att_tag, $items[$pos], $id);
            }
        }
    }

    // add an attribut with its value to output_array
    private function push_attribute($att_tag, $value, $att_id=null)
    {
        if (isset($att_id)) {
            $attribute = GW2_emb_Snippets::get_secondary_att($item_id, $att_tag);
        } else {
            $attribute = GW2_emb_Snippets::get_primary_att($att_tag);
        }

        if (!isset($attribute)) {
            shortcode_error('attributes incompatible');
        } elseif ($attribute === 1) {
            shortcode_error('wrong id format');
        }

        $this->output_array[$attribute] = $value;
    }







    // hand over the shortcode attributes to the class
    public function set_values($given_atts)
    {
        $process_array = $this->do_filter_array($given_atts);

        // evaluate inline-view additions
        if ($process_array['style'] === 'inline') {
            $process_array['style'] = 'display: inline-block; vertical-align: bottom;';
            if (!isset($process_array['size'])) {
                $process_array['size'] = '20';
            }
        }

        $this->output_array = $process_array;
    }




    // add additonal attributes to html-element
    protected function append_atts()
    {
        foreach ($this->output_array as $key => $value) {
            //echo $key.' > '.$value." ~~ ";
            $this->span->setAttribute($key, $value);
        }
        $this->append_additional();
    }

    protected function append_additional()
    {
        // none in default class
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
    }
}
