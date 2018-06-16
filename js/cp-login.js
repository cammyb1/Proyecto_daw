$(document).ready(function () {
  $("#set_sub").click(function(e){
    if(!basicformValidation(set_form,"#alert_set")){
      e.preventDefault();
    }
  });
  $("#login_sub").click(function(e){
    if(!basicformValidation(login_form,"#alert_login")){
      e.preventDefault();
    }
  });
  $("#recover_sub").click(function(e){
    if(!basicformValidation(recover_form,"#alert_recover")){
      e.preventDefault();
    }
  });

  function closeAlert(divId){
    $(divId).fadeOut(200);
  }
});
