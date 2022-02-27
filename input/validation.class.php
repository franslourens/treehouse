<?php

abstract class Validation {

  protected function is_required($value) {
    if($value != "" && $value !== 0) {
       return true;
    }

    return false;
  }

  protected function is_email($value) {

    $regex = "/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/";

    if(!preg_match($regex, $value))
    {
      return false;
    }

    return true;
  }

}
