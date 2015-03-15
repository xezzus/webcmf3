<?php
# value - id
return function($value){
  $valid = new core\valid($value);
  if(!$valid->is()) return false;
  $session = sha1(microtime(1).rand(1,10));
  $q = "insert into session (id,session,timeCreate) values ('{$value['id']}','$session','".time()."')";
  if(base\db::execute($q)){
    return $session;
  } else {
    return false;
  }

}
?>
