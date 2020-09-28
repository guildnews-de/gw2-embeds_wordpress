<?php

require_once $this->plugin_path . 'includes/shortcodes/amulets.php';
require_once $this->plugin_path . 'includes/shortcodes/items.php';
require_once $this->plugin_path . 'includes/shortcodes/skills.php';
require_once $this->plugin_path . 'includes/shortcodes/specs.php';
require_once $this->plugin_path . 'includes/shortcodes/traits.php';


function gw2arm_shortcodes_init()
{
    add_shortcode('gw2arm', 'gw2arm_shortcode');
}

add_action('init', 'gw2arm_shortcodes_init');
