<?php
namespace core;

class site {

  private static $css = [];
  private static $js = [];

  public function __destruct(){
    $file = function($nameView=null){
      if(empty($nameView)){
        $path = __DIR__."/../../web/page/";
      } else {
        $path = __DIR__."/../../web/view/$nameView/";
      }
      $uri = explode('/',$_SERVER['REQUEST_URI']);
      foreach($uri as $key=>$value){ if(empty(trim($value))) { unset($uri[$key]); continue; } }
      $uri = array_values($uri);
      for($i=count($uri)-1; $i>=0; $i--){
        $nextUri = implode('/',array_slice($uri,0,$i+1));
        $isFile = $path.$nextUri.'/index.phtml';
        if(is_file($isFile)) break;
        else $isFile = null;
      }
      if(!empty($uri) && isset($isFile)) return $isFile;
      else if(is_file($path.'index.phtml')) return $path.'index.phtml';
    };
    ob_start();
    require($file());
    $content = ob_get_clean();
    # get/set view
    preg_match_all('/\<\!\-\-[\s]*\{(.+)\}[\s]*\-\-\>/Ui',$content,$tpl);
    $tpl = array_map(function($tpl){
      $tpl = trim($tpl);
      return $tpl;
    },$tpl[1]);
    foreach($tpl as $key=>$value){
      if($file()) {
        ob_start();
        $findView =$file($value);
        if($findView) require($findView);
        $contentView = ob_get_clean();
        $content = preg_replace("/\<\!\-\-[\s]*\{$value\}[\s]*\-\-\>/Ui",$contentView,$content);
      }
    }
    # get/set variable
    preg_match_all('/\<\!\-\-[\s]*\[(.+)\][\s]*\-\-\>/Ui',$content,$tpl);
    $tpl = array_map(function($tpl){
      $tpl = trim($tpl);
      return $tpl;
    },$tpl[1]);
    # insert variable
    foreach($tpl as $key=>$value){
      if(!isset($this->{$value})) continue;
      if(is_array($this->{$value})) $this->{$value} = implode('',$this->{$value});
      $content = preg_replace("/\<\!\-\-[\s]*\[$value\][\s]*\-\-\>/Ui",$this->{$value},$content);
    }
    unset($key,$value);
    # add css
    $css = array_unique(self::$css);
    $css = '<link rel="stylesheet" type="text/css" href="/?css='.implode(';',$css).'" />';
    $content = preg_replace('/<\/head>/i',$css.'</head>',$content);
    # add javascript
    $js = array_unique(self::$js);

    $js = '<script type="text/javascript" src="/?js='.implode(';',$js).'" charset="UTF-8"></script>';
    $content = preg_replace('/<\/body>/i',$js.'</body>',$content);
    # compress
    $compress = new \util\compress;
    $content = $compress->html($content);
    # echo HTML
    echo $content;
  }

  public function __call($name,$value){ 
    return (new view($name,call_user_func_array('core\app::'.$name,$value)));
  } 
}
?>
