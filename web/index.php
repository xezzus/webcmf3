<?php
namespace core;

require_once(__DIR__.'/../autoload.php');

switch($_SERVER['HTTP_ACCEPT']){
  case "application/apps":
    (new apps);
  break;
  default:
    if(isset($_GET['css'])){
      header('Content-Type: text/css');
      (new css);
    } else if(isset($_GET['js'])) {
      header('Content-Type: application/javascript');
      (new js);
    } else {
      header('Content-Type: text/html');
      (new site);
    }
}
?>
