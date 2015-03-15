<?php
return function($value){
  $valid = new core\valid($value);
  if(!$valid->is()) return ['msg'=>'no valid'];
  $q = "select id from users where email = '{$value['email']}' and password = '{$value['password']}' limit 1";
  if($q = base\db::fetch($q)){
    if($session = self::sessionCreate($q)) return ['session'=>$session];
    else return ['msg'=>'no session'];
  } else {
    return ['msg'=>'no login'];
  }
}
?>
