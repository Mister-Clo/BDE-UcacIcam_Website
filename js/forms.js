jQuery(function($){

    let url_event = "http://localhost/BDE_Website/PHP_server/treat_events.php?todo=1";

    $("#event-form .image-file").on("change",function () {
        let val= $(this).val().toLowerCase();
        let nom = $("#event-form input[name='nom']").val();
        if((val.endsWith("jpg") || val.endsWith("png") || val.endsWith("jpeg")) && nom!=""){
            $("#event-form input[type='submit']").removeAttr('disabled');
        }else{
            $("#event-form input[type='submit']").attr('disabled','disabled');
        }
    });

    $("#event-form input[name='nom']").on("input",function () {
        let image = $("#event-form .image-file");
        let val= image.val().toLowerCase();
        let nom = $(this).val();
        if((val.endsWith("jpg") || val.endsWith("png") || val.endsWith("jpeg")) && nom!=""){
            $("#event-form input[type='submit']").removeAttr('disabled');
        }else{
            $("#event-form input[type='submit']").attr('disabled','disabled');
        }
    });

    $("#event-form").on("submit",function(e){

        e.preventDefault();
        let data = new FormData($(this).get(0));
        // let data = $(this).serialize();
        AjaxPost(url_event,data,function(data){
          //  alert(data);
            window.location.href="FutureEvents.php";
        });
    });

//post-form
    let url_post = "http://localhost/BDE_Website/PHP_server/treat_posts.php";

    $("#post-form .image-file").on("change",function () {
        let val= $(this).val().toLowerCase();
        if(val.endsWith("jpg") || val.endsWith("png") || val.endsWith("jpeg") ){
            $("#post-form input[type='submit']").removeAttr('disabled');
        }else{
            $("#post-form input[type='submit']").attr('disabled','disabled');
        }
    });

    $("#post-form").on("submit",function(e){

        e.preventDefault();
        //$("input[name='id_Event']").val($(".fa-comment-alt").attr("id-event"));
        let id_event = $("input[name='id_Event']").val();
         let data = new FormData($(this).get(0));
        // data = $(this).serialize();
        AjaxPost(url_post,data,function(data){
            //alert(data);
            window.location.href="posts.php?idevent="+id_event;
        });
    });


//comment-form
   $("#comment-form").on("submit",function(e) {
       e.preventDefault();
       let id_eventpost = $("input[name='id_eventsposts']").val();
       let url = "http://localhost/BDE_Website/PHP_server/treat_comments.php";
       let data = $(this).serialize();
       Ajax(url, data, 'POST',function (data) {
           $("#commentModal .modal-body .comments").html("");
           $("#commentModal .modal-body .comments").prepend(data);
       });
       $("#publication-input").val("");
       $("#comment-form input[type='submit']").attr('disabled','disabled');
   });

       $(".fa-comment-alt").on("click", function () {
           let id_post = $(this).attr("id-eventsposts");
           $("input[name='id_eventsposts']").val(id_post);
           let url = "http://localhost/BDE_Website/PHP_server/treat_comments.php";

           Ajax(url, '&id_post=' + id_post, 'GET', function (data) {
               $("#commentModal .modal-body .comments").html("");
               $("#commentModal .modal-body .comments").prepend(data);
               console.log(data);
           });
       });

    $("#publication-input").on("input",function () {
        if(!$(this).val().match("^([ ]*)$")){
            $("#comment-form input[type='submit']").removeAttr('disabled');
        }else{
            $("#comment-form input[type='submit']").attr('disabled','disabled');
        }
    });


       //fonctions
       function AjaxPost(url_, data_, success) {
           $.ajax({
               url: url_,
               type: 'POST',
               dataType: "text",
               processData: false,
               contentType: false,
               enctype: "multipart/form-data",
               data: data_,
               error: function (resultat, statut, erreur) {
                   console.error(erreur);
               },
               success: function (data, statut) {
                   success(data);
               }
           });
       }

    function Ajax(url_, data_, method_, success) {
        $.ajax({
            url: url_,
            type: method_,
            dataType: "text",
            data: data_,
            error: function (resultat, statut, erreur) {
                console.error(erreur);
            },
            success: function (data, statut) {
                success(data);
            }
        });
    }


});