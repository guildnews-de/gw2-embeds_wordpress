<?php
class GW2arm_embedBasic
{
    protected $type;
    protected $id;
    protected $dom;
    protected $span;

    protected function basicValues($confArray)
    {
        $this->type = $confArray['type'];
        // filter empty spaces
        $this->id = preg_replace('/\s+/', '', $confArray['id']);
    }

    public function setValues($confArray)
    {
        $this->basicValues($confArray);
    }

    protected function createEmbed()
    {
        // create new <div>
        $this->dom = new DOMDocument();
        $this->span = $this->dom->createElement('span');
        // set GW2armory config
        $this->span->setAttribute('data-armory-embed', $this->type);
        $this->span->setAttribute('data-armory-ids', $this->id);
    }

    public function getEmbed()
    {
        $this->createEmbed();

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}

class GW2arm_embedDefault extends GW2arm_embedBasic
{
    protected $text;
    protected $blank;
    protected $size;
    protected $inline;

    public function setValues($confArray)
    {
        $this->basicValues($confArray);
        // additional Values
        foreach ($confArray as $key => $value) {
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
              if (!isset($confArray['size'])) {
                  $this->size = '20';
              }
          }
          break;
        default:
          break;
      }
        }
    }

    protected function setConfig()
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

    public function getEmbed()
    {
        $this->createEmbed();
        $this->setConfig();

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}

class GW2arm_embedsSpec extends GW2arm_embedBasic
{
    public $traits;

    public function setValues($confArray)
    {
        $this->basicValues($confArray);
        // additonal Values
        foreach ($confArray as $key => $value) {
            switch ($key) {
          case 'type':
            $this->type = 'specializations';
            break;
          case 'traits':
            // filter empty spaces
            $this->traits = preg_replace('/\s+/', '', $value);
            break;
          default:
            break;
        }
        }
    }

    protected function setConfig()
    {
        if (isset($this->traits)) {
            $this->id = explode(',', $this->id);
            $this->traits = explode(';', $this->traits);

            for ($i=0; $i < sizeof($this->id); $i++) {
                $id = $this->id[$i];
                $tr = isset($this->traits[$i]) ? $this->traits[$i] : '';
                $this->span->setAttribute('data-armory-'.$id.'-traits', $tr);
            }
        }
    }

    public function getEmbed()
    {
        $this->createEmbed();
        $this->setConfig();

        $this->dom->appendChild($this->span);
        return $this->dom->saveHTML();
    }
}
