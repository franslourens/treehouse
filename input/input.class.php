<?php

abstract class Input {
  public $class = '';
  public $disabled = '';
  public $id = '';
  public $name = '';
  public $style = '';
  public $value = '';
  public $readonly = '';
  public $label = '';

  public function __construct($options) {
    if($options['name'] && !isset($options['id']) && empty($options['id'])) {
      $options['id'] = $options['name'];
    }

    if($options['id'] && !$options['name']) {
      $options['name'] = $options['id'];
    }

    if(is_array($options)) {
      $this->parseOptions($options);
    } else {
      $this->id = $options;
      $this->name = $options;
    }
  }

  protected function parseOptions($options){
    foreach ($options as $key => $value) {
      if(isset($this->$key)) {
        $this->$key = $value;
      } else {
        $this->_error("unknown variable $key");
      }
    }
  }

  protected function _error($text){
    echo $text;
  }

  protected function html() {
    $html = '';
    $class = 'class';

    if($this->$class) {
      $html .= ' class="'.$this -> $class.'"';
    }

    if($this->disabled) {
      $html .= ' disabled="'.$this -> disabled.'"';
    }

    if($this->id) {
      $html .= ' id="'.$this -> id.'"';
    }

    if($this->name) {
      $html .= ' name="'.$this -> name.'"';
    }

    if($this->style) {
      $html .= ' style="'.$this -> style.'"';
    }

    if($this->readonly) {
      $html .= ' readonly="'.$this -> readonly.'"';
    }

    return $html;
  }
}
