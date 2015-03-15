<?php
namespace core;

class view {

  private static $name;
  private static $value;

  public function __construct($name,$value){
    self::$name = $name;
    self::$value = $value;
    foreach(self::$value as $key=>$value){ $this->{$key} = $value; }
  }

  public function json(){
    return json_encode(self::$value);
  }

  public function html(){
    $file = __DIR__.'/../../apps/'.self::$name.'/index.phtml';
    if(is_file($file)) {
      require($file);
    }
  }

}

?>
