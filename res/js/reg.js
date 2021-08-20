$(document).ready(()=>{
    let correct1 = false; // login
    let correct2 = true; // pass1
    let correct3 = true;// pass 2
    let correct4 = true; // email


    let regExp1 = /^[a-zA-Z][a-zA-Z0-9\-.]{5.15}$/;
    let reqExp2 = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[_\-.])[A-Za-z0-9_\-.]{8,}/
    let regExp3 = /([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}/

    //check login
  $('#login').blur(()=>{
      let loginValue = $("#login").val();
      if (regExp1.test(loginValue)){
          $.ajax({
              type:"POST",
              url:"/php/teach-assistant/auth/ajax_check_login",
              data:'login='+loginValue,
              success: function (result){
                  if (result ==="taken"){
                      correct1=false;
                  $('#login-error').html("Логин занят")
                  }else{
                      $('#login-error').html('')
                      correct1=true
                  }
              }
          });

      }else{
          correct1=false
          $('#login-error').html('Логин не соответствует шаблону безопасности');
      }
  })

    //check password -1
    $('#pass1').blur(()=>{
        let pass1Value = $("#pass1").val();
        if (regExp2.test(pass1Value)){

            correct2=true
            $('#pass1-error').html('');
        }else{
            correct2=false
            $('#pass1-error').html('Пароль не соответствует шаблону безопасности');
        }
    })

    //check password -2
    $('#pass2').blur(()=>{
        let pass1Value = $("#pass1").val();
        let pass2Value = $("#pass2").val();
        if (pass1Value ===pass2Value){

            correct3=true
            $('#pass2-error').html('');
        }else{
            correct3=false
            $('#pass2-error').html('Пароль не совпадают');
        }
    })

        // Check E-mail
    $('#email').blur(()=>{
        let emailValue = $("#email").val();
        if (regExp3.test(emailValue)){
            $.ajax({
                type:"POST",
                url:"/php/teach-assistant/auth/ajax_check_email",
                data:'email='+emailValue,
                success: function (result){
                    if (result ==="taken"){
                        correct1=false;
                        $('#email-error').html("Email занят")
                    }else{
                        $('#email-error').html('')
                        correct1=true
                    }
                }
            });

        }else{
            correct1=false
            $('#email-error').html('Логин не соответствует шаблону безопасности');
        }
    })

    //final check of results of validation
    $("#submit").click(()=>{
       if (correct1 === true && correct2===true &&
       correct3 ===true && correct4===true){
           alert("validate true");
           $('#regform').attr('onsubmit','return true')
       }else{
           let blockMessage = "Форма содержить некорректные данные!\n";
           blockMessage +="Отправка данных заблокирована!";
           alert(blockMessage)
       }
    })

})