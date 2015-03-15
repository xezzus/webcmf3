var cookie = {
  set:function(name,value,sec){ 
    var exdate=new Date(); 
    var sec=exdate.getSeconds()+sec; 
    exdate.setSeconds(sec); 
    document.cookie=name+ "=" +escape(value)+((sec==null) ? "" : ";expires="+exdate.toGMTString()+"; path=/;");
  },
  get:function(name){ 
    var start=document.cookie;
    var start = start.split(";");
    for(var key in start){
      var check = start[key].split('=');
      check[0] = check[0].replace(" ","");
      if(name==check[0]) {
        return unescape(check[1]);
      }
    }
    return '';
  },
  del:function(name){
    document.cookie = name+"=''; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/;";
  }
}
