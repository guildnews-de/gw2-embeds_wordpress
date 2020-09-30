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
        self::$shortcodes[ $data ] = $data.'_shortcode';
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
}
