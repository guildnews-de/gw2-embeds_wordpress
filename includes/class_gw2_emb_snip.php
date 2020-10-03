<?php

class GW2_emb_Snip
{
    const PLUGIN_PREFIX = 'gw2_embeddings_';
    const SC_PREFIX = 'gw2emb_';
    const ATTS_PREFIX = 'data-armory-';

    const PRIMARY = array(
  'type' => 'embed',
  'id' => 'ids',
  'text' => 'inline-text',
  'size' => 'size',
  'blank' => 'blank-text',
  );

    const SECONDARY = array(
  'traits' => '-traits',
  'skin' => '-skin',
  'stat' => '-stat',
  'infusions' => '-infusions',
  'upgrade' => '-upgrades',
  'count' => '-upgrade-count',
  );


    public static $plugin_path;
    public static $plugin_url;

    /**
    *   calls for some snippet strings
    */

    public static function add_atts_prefix($string)
    {
        return self::ATTS_PREFIX . $string;
    }

    public static function add_sc_prefix($string)
    {
        return self::SC_PREFIX . $string;
    }

    public static function add_plugin_prefix($string)
    {
        return self::PLUGIN_PREFIX . $string;
    }


    public static function get_primary_att($type)
    {
      if (isset(self::PRIMARY[$type])) {
        $snippet = self::ATTS_PREFIX . self::PRIMARY[$type];
        return $snippet;
      }

      return;

    }

    public static function get_secondary_att($type, $id)
    {
      if (isset(self::SECONDARY[$type])) {
        if (ctype_digit($id)) {
          $snippet = self::ATTS_PREFIX . $id . self::SECONDARY[$type];
          return $snippet;
        } else {
          return 1;
        }
      }
      return;
    }

    /**
    *   requirement calls for the shortcode handlers
    */

    public static function require_sc_default(){
      require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_default.php';
    }

    public static function require_sc_items(){
      self::require_sc_default();
      require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_items.php';
    }

    public static function require_sc_specs(){
      self::require_sc_default();
      require_once self::$plugin_path . 'includes/shortcodes/class_gw2_emb_shortcode_specs.php';
    }

}
