<?php
namespace core;

class app {

  private static $singleton = [];
    
  public static function __callStatic($name,$value){
    $file = __DIR__.'/../../apps/'.$name.'/index.php';
    if(is_file($file)) return call_user_func_array(require($file),$value);
  }

}
?>
