<?php

class Submit extends Input {

  public function __construct($options){

    if(!is_array($options)){
      $o = array();
      $o['value'] = $options;
      $o['name'] = 'submit';
      $o['id'] = 'submit';
    } else {
      $o = $options;
    }
    parent::__construct($o);
  }

  public function show(){
    $class = 'class';

    if(!$this->$class) {
      $class = ' class="button"';
    }

    $html = '<button '.$class.' type="submit">';
    $html .= $this->value;
    $html .= '<img id="form_loader" class="loader" src="loader.png" style="margin-left: 10px;" />';
    $html .= "</button>";

    return $html;
  }
}
