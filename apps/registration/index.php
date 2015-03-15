<?php
return function($value){
  # valid
  $valid = new core\valid($value);
  if(!$valid->is()) return ['msg'=>'no valid'];
  # begin
  $q = "insert into users (email,name,password) values ('{$value['email']}','{$value['name']}','{$value['password']}')";
  if(base\db::execute($q)){
    return ['insert'=>'yes'];
  } else {
    return ['insert'=>'no'];
  }
}
?>

