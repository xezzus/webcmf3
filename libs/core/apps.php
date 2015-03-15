<?php
namespace core;

class apps {

  public function __destruct(){
    $json = file_get_contents('php://input');
    $json = json_decode($json,1);
    foreach($json as $name=>$value){
      $value = call_user_func('core\app::'.$name,$value);
      $view = new view($name,$value);
      ob_start();
      $view->html();
      $content = ob_get_clean();
      if(empty($content)) $content = $value;
      $json[$name] = $content;
    }
    die(json_encode($json));
  }
}
?>
