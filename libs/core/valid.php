<?php
namespace core;

class valid {

  private $preg;
  private $value;

  public function __construct($value){
    $this->value = $value;
    $this->preg = require(__DIR__.'/../../valid.php');
  }

  public function is(){
    foreach($this->value as $key=>$value){
      if(!isset($this->preg[$key])) return false;
      if(!preg_match('/'.$this->preg[$key].'/Ui',$value)) return false;
    }
    return true;
  }

  public function filter(){
    $filter = [];
    foreach($this->value as $key=>$value){
      if(!isset($this->preg[$key])) {
        $filter[$key] = false;
        continue;
      }
      if(!preg_match('/'.$this->preg[$key].'/Ui',$value)) $filter[$key] = false;
      else $filter[$key] = true;
    }
    return $filter;
  }

}
?>
