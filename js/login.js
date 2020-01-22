
(function ($) {
    "use strict";
    const API_LOGIN_URL = "http://localhost:8080/api/users/login";
    const API_REGISTER_URL = "http://localhost:8080/api/users/register";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/

    $("#password_instructions").find(".fa-check").hide();

    $('.connexion-form').on('submit',function(e){
        e.preventDefault();

        var input = $('.connexion-form .validate-input .input100');
        var $validate=true;
        var $data= $(this).serialize();

        for(var i=0; i<input.length; i++) {
            var $error_message = validate(input[i]);
            $validate=($validate && ($error_message=="" ? true : false));
            showValidate(input[i],$error_message);
        }

        if($validate){
            AjaxPost(API_LOGIN_URL,$data,"connexion");
        }
    });

    $('.inscription-form').on('submit',function(e){
       
        e.preventDefault();

        var input = $('.inscription-form .validate-input .input100');
        var $validate=true;
        var $data= $(this).serialize();

        for(var i=0; i<input.length; i++) {
            var $error_message = validate(input[i]);
            $validate=($validate && ($error_message=="" ? true : false));
            showValidate(input[i],$error_message);
        }

        if($validate){
            AjaxPost(API_REGISTER_URL,$data,"inscription");
        }
    })

    $(".input100[name='password_inscription']").on('input',function(){

        var input = $('.inscription-form .validate-input input:password');

        atLeast8(input);
        contains_maj(input);
        contains_num(input);
        
    });

    $('.login100-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });


    function validate (input) {
       var $error="";
        if($(input).val().trim() == '' || $(input).val()=="Default"){
            $error = $(input).parent().attr("data-validate");
        }
        else {
            if($(input).attr('type') == 'email') {
                /*"^([a-zA-Z0-9]+)\.[a-zA-Z0-9]@202[0-9]{1}\.(ucac-icam)\.(com)$"*/
                if(!$(input).val().match("^[a-zA-Z0-9\._%+-]+@[a-zA-Z_-]+\.(com|fr|net)$")) {
                    $error = "Email invalide";
                }
            }else if($(input).attr("name") == "password_inscription"){
                if(!atLeast8(input) || !contains_maj(input) || !contains_num(input)){
                $error = "votre mot de passe doit respecter tous les critères énumérés ci-dessous";
                }
            }
        }

        return $error;
    }


    function atLeast8(input){
        if($(input).val().length <= 8){
           $("#password_instructions").find(".fa-check").eq(0).hide();
            return false;    
        }else{
            $("#password_instructions").find(".fa-check").eq(0).show();
            return true;
        }
    }

    function contains_maj(input){
        if($(input).val().match("[A-Z]+")){
            $("#password_instructions").find(".fa-check").eq(1).show();
            return true;
        }else{
            $("#password_instructions").find(".fa-check").eq(1).hide();
            return false;
        }
    }

    function contains_num(input){
        if($(input).val().match("[0-9]+")){
            $("#password_instructions").find(".fa-check").eq(2).show();
            return true;
        }else{
            $("#password_instructions").find(".fa-check").eq(2).hide();
            return false;
        }
    }

    // Les validations du serveur 
    function serverValidation ($errors) {

       for(var key in $errors){

        var input = $(".input100[name='"+key+"']");
        var $error_zone = $(input).parent().next(".input-error");
           $error_zone.text($errors[key]);

       }
     }

 
    function showValidate(input,$error_message) {
        var $error_zone = $(input).parent().next(".input-error");
        $error_zone.text($error_message);

        if($(input).find("option").length != 0){
            $(input).parent().css({
                borderColor : "red",
            });
        }
        else{
            $(input).parent().css({
                borderBottomColor : "red",
            });
        }
    }

    function hideValidate(input) {
        var $error_zone = $(input).parent().next(".input-error");
        $error_zone.text("");

        if($(input).find("option").length == 0){
            $(input).parent().css({
                borderBottomColor : "#adadad",
            });
        }
     
        
    }

 function AjaxPost(url_,data_,type){
    $.ajax({
        url:url_,
        type:"POST",
        dataType:"text",
        data:data_,
        success: function(data,statut){

            if(type == "inscription"){
                if(data != "done"){
                  serverValidation(JSON.parse(data));
                }else{
                  console.log("a");
                   $(".wrap-login101").append("<div class='alert alert-success' style='text-align:center'>Votre compte a été créé avec succès. Vous pouvez vous connecter à présent</div>");
                  // $(".dropdown-item[data-target='#connexionModal']").click();
                   }
            }

            else if(type == "connexion"){
                if(data.toString().startsWith('{') && data.toString().endsWith('}')){
                    $.ajax({
                        url:"http://localhost/BDE_Website/PHP_server/treat_connexion.php",
                        type:"POST",
                        dataType:"text",
                        data:JSON.parse(data),
                        success: function(data,statut){
                           window.location.href="./index.php";
                        }
                    });
                }else{
                   $("#notFound").html("<div class='alert alert-danger' style='text-align:center'>"+data+"</div>");
                  // $(".dropdown-item[data-target='#connexionModal']").click();
                }
            }
        } 
     });
}
   
 
    
    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
    });


})(jQuery);