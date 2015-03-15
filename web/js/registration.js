$(function(){
  $('form[name=registration] input[type=button][name=reg]').on('click',function(){
    fw.sendForm('registration',function(res){});
  });
});
