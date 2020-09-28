<?php

class GW2_Embeddings
{
    private $plugin_path;
    private $shortcodes = [];

    public function __construct($path)
    {
        $this->plugin_path = $path;

        $this->load_includes();
        $this->register_shortcodes();
    }

    private function load_includes()
    {
        require_once $this->plugin_path . 'includes/shortcodes/0_include_shortcodes';
    }

    public function add_shortcode($data)
    {
        $this->shortcodes[ $data ] = $data.'_shortcode';
    }

    private function register_shortcodes()
    {
        $prefix = GW2arm_Snippets::get_sc_prefix();

        foreach ($this->shortcodes as $tag => $callback) {

            add_shortcode($prefix . $tag, $callback);
        }
    }
}



class GW2arm_shortcode
{
    private $short_atts;

    private $short_tag;


    public function parse_attributes($input_atts)
    {
        $output_atts = $this->do_format_atts($input_atts);

        if ($this->has_valid_type($output_atts)) {
            $this->shortcode_atts = $output_atts;
        } else {
            $this->error('type not set or unsupported');
        }
    }

    private function do_format_atts($raw_atts)
    {
        // change all to lower case
        $form_atts = array_change_key_case($raw_atts, CASE_LOWER);

        // emliminate spaces
        $form_atts['id'] = preg_replace('/\s+/', '', $form_atts['id']);
        if (isset($form_atts['traits'])) {
            $form_atts['traits'] = preg_replace('/\s+/', '', $form_atts['traits']);
        }

        return $form_atts;
    }

    private function has_valid_type($with)
    {
        if (in_array($with['type'], array('skills', 'spec', 'items', 'amulets', 'traits'))) {
            return true;
        } else {
            return false;
        }
    }

    public function get_embedding()
    {
        switch ($this->shortcode_atts['type']) {
      case 'spec':
        $handler = new GW2arm_embed_spec();
        break;
      case 'items':
        $handler = new GW2arm_embed_items();
        break;
      default:
        $handler = new GW2arm_embed_default();
        break;
    }
        $handler->set_values($this->shortcode_atts);
        $embedding_html = $handler->create_embedding();

        return $embedding_html;
    }

    private function error($string)
    {
        $message = array(
      'type' => 'skills',
      'id' => '-1',
      'text' => '',
      'style' => 'display:inline',
      'size' => '',
      'blank' => ' ~~ Shortcode error: "'.$string.'" ~~ ',
      );

        $this->shortcode_atts = $message;
    }
}
