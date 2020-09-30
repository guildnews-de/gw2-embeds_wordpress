<?php

GW2_emb_shortcodes::add('traits');

function gw2emb_traits($atts = [], $content, $tag){

  require_once $this->plugin_path . 'includes/shortcodes/GW2_emb_Shortcode_Parent.php';

  $shortcode = new GW2_emb_Shortcode_Parent($atts, $tag);

  $embedding = $shortcode->get_embedding();

}
