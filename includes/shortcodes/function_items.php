<?php

GW2_emb_shortcodes::add('items');

function gw2emb_items_handler($atts = [], $content, $tag){

  GW2_emb_Snippets::require_sc_items();

  $shortcode = new GW2_emb_Shortcode_Items($atts, $tag);

  $embedding = $shortcode->get_embedding();

  GW2_emb_shortcodes::check_scripts();

  return $embedding;
}
