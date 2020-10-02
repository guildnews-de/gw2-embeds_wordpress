<?php

GW2_emb_shortcodes::add('amulets');

function gw2emb_amulets_handler($atts = [], $content, $tag){

  GW2_emb_Snippets::require_sc_default();

  $shortcode = new GW2_emb_Shortcode_Default($atts, $tag);

  $embedding = $shortcode->get_embedding();

  GW2_emb_shortcodes::check_scripts();

  return $embedding;

}
