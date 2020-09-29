<?php

require_once $this->plugin_path . 'includes/shortcodes/function_amulets.php';
require_once $this->plugin_path . 'includes/shortcodes/function_items.php';
require_once $this->plugin_path . 'includes/shortcodes/function_skills.php';
require_once $this->plugin_path . 'includes/shortcodes/function_specs.php';
require_once $this->plugin_path . 'includes/shortcodes/function_traits.php';


function gw2arm_shortcodes_init()
{
    add_shortcode('gw2arm', 'gw2arm_shortcode');
}

add_action('init', 'gw2arm_shortcodes_init');
