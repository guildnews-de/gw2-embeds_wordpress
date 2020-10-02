<?php
/**
 *  Basic embedding contructor class
 */

class GW2_emb_Shortcode_Items extends GW2_emb_Shortcode_Default
{
    protected $filter_array_prim = array(
      'id' => '',
      'text' => '',
      'blank' => '',
      'style' => '',
      'size' => '',
      );

    protected $filter_array_sec = array(
      'skin' => '',
      'stat' => '',
      'infusions' => '',
      'upgrades' => '',
      );


    protected function parse_special_atts($atts)
    {
        if (isset($atts['upgrades'])) {
            $upgr_array = explode(';', $atts['upgrades']);

            foreach ($upgr_array as $pos1 => $value) {
                $upgr_str = $this->filter_upgrade_count($value,$pos1);

                $this->push_attribute('upgrade', $upgr_str, $this->id_array[$pos1]);
            }
        }
        unset($atts['upgrades']);
        return $atts;
    }

    protected function filter_upgrade_count($upgr_value, $id_pos)
    {
        if (strpbrk($upgr_value, '+')) {
            $fragments = explode(',', $upgr_value);

            foreach ($fragments as $pos2 => $value) {
                if (strpbrk($value, '+')) {
                    $count = explode('+', $value);
                    $count_str = '{"' . $count['0'] . '": ' . $count['1'] . '}';
                    $count_id = $this->id_array[$id_pos];

                    $this->push_attribute('count', $count_str, $count_id);
                    $fragments[$pos2] = $count['0'];
                }
            }
            $upgr_value = implode(',', $fragments);
        }
        return $upgr_value;
    }
}
