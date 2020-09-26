<?php
class GW2arm_embed_basic
{
  protected $dom;
  protected $span;
  protected $type;
  protected $id;

    // hand over the shortcode attributes to the class
    public function set_values($given_atts)
    {
        $this->set_basic_values($given_atts);
    }

    protected function set_basic_values($given_atts)
    {
        $this->type = $given_atts['type'];
        $this->id = $given_atts['id'];
    }

    // create empty html-element
    protected function create_dom()
    {
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');
        // directly add basic (always given) attributes
        $this->span->setAttribute('data-armory-embed', $this->type);
        $this->span->setAttribute('data-armory-ids', $this->id);
    }

    // add additonal attributes to html-element
    protected function append_atts(){
      // none in basic class
    }

    // execute html-building functions and return element
    public function create_embedding()
    {
      if(isset($this->type)){
        $this->create_dom();
        $this->append_atts();
      } else {
        return 'type not set';
      }

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}

class GW2arm_embed_default extends GW2arm_embed_basic
{
    protected $text;
    protected $blank;
    protected $size;
    protected $inline;

    public function set_values($given_atts)
    {
        $this->set_basic_values($given_atts);

        // additional Values
        foreach ($given_atts as $key => $value) {
            switch ($key) {
        case 'text':
          $this->text = $value;
          break;
        case 'blank':
          $this->blank = $value;
          break;
        case 'size':
          $this->size = $value;
          break;
        case 'inline':
          if ($value = '1') {
              $this->inline = true;
              if (!isset($given_atts['size'])) {
                  $this->size = '20';
              }
          }
          break;
        default:
          break;
      }
        }
    }

    protected function append_atts()
    {
        if (isset($this->text)) {
            $this->span->setAttribute('data-armory-inline-text', $this->text);
        }
        if (isset($this->blank)) {
            $this->span->setAttribute('data-armory-blank-text', $this->blank);
        }
        if (isset($this->size)) {
            $this->span->setAttribute('data-armory-size', $this->size);
        }
        if (isset($this->inline)) {
            $this->span->setAttribute('style', 'display: inline-block; vertical-align: bottom;');
        }
    }
}

class GW2arm_embed_spec extends GW2arm_embed_basic
{
    protected $traits;

    public function set_values($given_atts)
    {
        $this->set_basic_values($given_atts);
        // additonal Values
        foreach ($given_atts as $key => $value) {
            switch ($key) {
          case 'type':
            $this->type = 'specializations';
            break;
          case 'traits':
            // filter empty spaces
            $this->traits = $value;
            break;
          default:
            break;
        }
        }
    }

    protected function append_atts()
    {
        if (isset($this->traits)) {
            $trait_ids = explode(',', $this->id);
            $trait_values = explode(';', $this->traits);

            for ($i=0; $i < sizeof($trait_ids); $i++) {
                $i_id = $trait_ids[$i];
                if (ctype_digit($i_id)) {
                  $i_traits = isset($trait_values[$i]) ? $trait_values[$i] : '';
                  $this->span->setAttribute('data-armory-'.$i_id.'-traits', $i_traits);
                } else {
                  break;
                }          
            }
        }
    }
}
