<?php

class GW2_emb_Shortcode_Parent
{
    protected $filter_array = array(
      'id' => '-1',
      'text' => '',
      'style' => '',
      'size' => '',
      'blank' => '',
      );

    protected $id_array = [];
    protected $output_array = [];

    protected $dom;
    protected $span;


    public function __construct($atts, $tag)
    {
        // prepare empty html-element
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');

        parse_attributes($atts);


    }

    protected function parse_attributes(){

    }

    private function parse_secondary_att($att_tag,$value_str)
    {
      $items = explode(';', $value_str);

      foreach ($this->id_array as $pos => $id) {
        if (isset($items[$pos])) {
          push_item_adds($att_tag, $items[$pos], $id);
        }
      }
    }

    // add an attribut with its value to output_array
    private function push_attribute($att_tag, $value, $att_id=NULL){
      if (isset($att_id)) {
        $attribute = GW2_emb_Snippets::get_secondary_att($item_id, $att_tag);
      } else {
        $attribute = GW2_emb_Snippets::get_primary_att($att_tag);
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


    // filter unsupported or empty keys and beautify
    protected function do_filter_array($raw_array)
    {
        // filter unsupported attributes
        $form_array = shortcode_atts($this->filter_array, $raw_array);

        // filter empty keys
        $form_array = array_filter($form_array);

        return $form_array;
    }

    // add additonal attributes to html-element
    protected function append_atts()
    {
        foreach ($this->output_array as $key => $value) {
            //echo $key.' > '.$value." ~~ ";
            if (GW2arm_Snippets::PRIMARY[$key]) {
                $this->span->setAttribute(GW2arm_Snippets::get_Snippet($key), $value);
            }
        }
        $this->append_additional();
    }

    protected function append_additional()
    {
        // none in default class
    }

    // execute html-building functions and return element
    public function create_embedding()
    {
        if (isset($this->output_array)) {
            $this->append_atts();
        } else {
            return 'attributes not set';
        }

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}
