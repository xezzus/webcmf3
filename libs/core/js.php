<?php
namespace core;

class js {

  public function __destruct(){
    die(implode(array_map(function($file){
      $file = __DIR__.'/../../web/js/'.$file.'.js';
      if(!is_file($file)) return '';
      $content = file_get_contents($file);
      return $content;
    },explode(';',$_GET['js']))));
  }

}
?>
