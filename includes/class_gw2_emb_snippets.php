<?php
class GW2_emb_Snippets
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
  'style' => 'style',
  );

    const SECONDARY = array(
  'traits' => '-traits',
  'skin' => '-skin',
  'stat' => '-stat',
  'infusions' => '-infusions',
  'upgrades' => '-upgrades',
  'count' => '-upgrade-count',
  );


    public static function add_atts_prefix($string)
    {
        return self::ATTS_PREFIX . $string;
    }

    public static function get_sc_prefix($string)
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

    public static function get_secondary_att($id, $type)
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

}
