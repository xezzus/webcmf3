$(function(){
$('form[name=login] input[type=button][name=login]').on('click',function(){
  fw.sendForm('login',function(res){
    res = res.login;
    if('session' in res){
      cookie.set('session',res.session,99999*99999);
      window.location.href = '/';
    }
  });
});
});
