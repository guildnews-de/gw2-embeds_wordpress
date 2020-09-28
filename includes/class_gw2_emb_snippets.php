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


    public static function get_atts_prefix()
    {
        return self::ATTS_PREFIX;
    }

    public static function get_sc_prefix()
    {
        return self::SC_PREFIX;
    }

    public static function get_plugin_prefix()
    {
        return self::PLUGIN_PREFIX;
    }


    public static function get_primary_att($type)
    {
        $snippet = self::ATTS_PREFIX . self::PRIMARY[$type];
        return $snippet;
    }

    public static function get_secondary_att($id, $type)
    {
      if (ctype_digit($id)) {
        $snippet = self::ATTS_PREFIX . $id . self::SECONDARY[$type];
        return $snippet;
      } else {
        return ;
      }

    }

}
