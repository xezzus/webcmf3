<?php
return function(){
  if(!isset(self::$singleton['singleton'])){
    $time = microtime(1);
    self::$singleton['singleton'] = ['time'=>$time];
  }
  return self::$singleton['singleton'];
}
?>
