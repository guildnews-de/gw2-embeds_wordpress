<?php

/**
 *  Shortcode management class
 */


class GW2_emb_shortcodes
{

    private static $shortcodes = [];


    // triggered by each shortcode file
    public static function add($data)
    {
        self::$shortcodes[ $data ] = $data.'_handler';
    }

    // init-function for wordpress
    public static function register()
    {
        $prefix = GW2_emb_Snippets::SC_PREFIX;
        $shortcodes = self::$shortcodes;

        foreach ($shortcodes as $tag => $callback) {

            add_shortcode($prefix . $tag, $prefix . $callback);
        }
    }

    public static function check_scripts(){
        // check if scripts are added
        wp_enqueue_script('GW2arm-locale.js', GW2_emb_Snippets::$plugin_url . 'languages/js/gw2arm_locale.js', null, null, true);
        wp_enqueue_script('armory-embeds.js', "https://unpkg.com/armory-embeds@^0.x.x/armory-embeds.js", null, null, true);


  }
}
