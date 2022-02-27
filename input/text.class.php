<?php

class Text extends Input {

  public function show(){
    $class = 'class';

    if(!$this->$class){
      $class = ' class="text"';
    }
    $html = '<input '. $class .' type="text" style="padding:1px 20px 1px 20px;" ';
    $html .= $this->html();
    $html .= ' value="'. $this->value .'"';
    $html .= ' />';

    return $html;
  }
}
