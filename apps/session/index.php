<?php
return function(){
  if(!isset(self::$singleton['session'])){
    $time = microtime(1);
    self::$singleton['session'] = ['time'=>$time];
  }


  return self::$singleton['session'];
}
?>

