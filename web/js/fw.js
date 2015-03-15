var fw = {
  q:function(cmd,callback){
    // act
    var act = {};
    if(typeof cmd == 'string'){ act[cmd] = null }
    else act = cmd;
    // xhr
    var xhr = new XMLHttpRequest;
    var accept = 'application/apps';
    xhr.open("POST", window.location.pathname, true);
    xhr.setRequestHeader('Accept',accept); // view/json, view/html
    xhr.send(JSON.stringify(act));
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4){
        var response = JSON.parse(xhr.responseText);
        callback(response);
      }
    }
  },
  getForm:function(name){
    var form = document.getElementsByTagName('form')[name];
    var input = form.getElementsByTagName('input');
    var data = {};
    for(i = 0; i<=input.length-1; i++){
      if(input[i].name != '' && (input[i].type == 'text' || input[i].type == 'password' || input[i].type == 'hidden')){
        data[input[i].name] = input[i].value;
      }
    }
    return data;
  },
  sendForm:function(name,callback){
    var apps = {};
    apps[name] = fw.getForm(name);
    fw.q(apps,function(reply){callback(reply);});
    return true;
  }
}
