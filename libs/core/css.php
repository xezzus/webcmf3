<?php
namespace core;

class css {

  public function __destruct(){
    die(implode(array_map(function($file){
      $file = __DIR__.'/../../web/css/'.$file.'.css';
      if(!is_file($file)) return '';
      $content = file_get_contents($file);
      return $content;
    },explode(';',$_GET['css']))));
  }

}
?>
