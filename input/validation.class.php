<?php

abstract class Validation {

  protected function notEmpty($value, $param) {
    if($value != "" && $value !== 0 && strlen($value) >= $param) {
       return true;
    }

    return false;
  }

  protected function email($value){

    if(!preg_match('|^[_a-z0-9.-]*[a-z0-9]@[_a-z0-9.-]*[a-z0-9].[a-z]{2,3}$|e', $value))
    {
      return false;
    }

    return true;
  }

}
