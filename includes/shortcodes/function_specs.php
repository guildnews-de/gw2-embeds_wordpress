<?php

GW2_emb_shortcodes::add('specs');

function gw2emb_specs_handler($atts = [], $content, $tag){

  GW2_emb_Snippets::require_sc_specs();

  $tag = GW2_emb_Snippets::SC_PREFIX.'specializations';

  $shortcode = new GW2_emb_Shortcode_Specs($atts, $tag);

  $embedding = $shortcode->get_embedding();

  GW2_emb_shortcodes::check_scripts();

  return $embedding;
}
