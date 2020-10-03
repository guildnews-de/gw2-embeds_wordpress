<?php

class GW2_Embeddings
{

    public function __construct($plugin_file)
    {
        GW2_emb_Snip::$plugin_path  =  plugin_dir_path($plugin_file);
        GW2_emb_Snip::$plugin_url   =  plugin_dir_url($plugin_file);

        $this->load_includes();
        $this->define_common_hooks();
    }

    // include essential files and load shortcodes
    private function load_includes()
    {


        // load shortcode management class
        require_once GW2_emb_Snip::$plugin_path . 'includes/class_gw2_emb_shortcodes.php';

        // load available shortcodes
        require_once GW2_emb_Snip::$plugin_path . 'includes/shortcodes/0_include_shortcodes.php';
    }

    private function define_common_hooks()
    {

        /**
        * Register available shortcodes.
        */
        add_action('init', array( 'GW2_emb_Shortcodes', 'register' ));
    }
}
