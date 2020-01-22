jQuery(function($){

    let nav_height = $("#main_navbar").outerHeight(true);
    var recherche_height = $("#recherche").outerHeight(true);

    $("body").css({marginTop:nav_height});
    $("#recherche").css({marginTop: nav_height});
    $(".bd-example").css({marginTop: recherche_height});
    $("aside").css({marginTop: recherche_height});

   // alert($("#main_navbar").outerHeight(true));
    $(window).resize(function(){
        var nav_height = $("#main_navbar").outerHeight(true);
        var recherche_height = $("#recherche").outerHeight(true);

        $("body").css({marginTop:nav_height});
        $("#recherche").css({marginTop: nav_height});
   });


    // Gestion du timeout
    $(document).on("click",function(){
        $.ajax({
            url:"http://localhost/BDE_Website/PHP_server/timeout.php",
            type:"GET",
            success: function(data,statut){
                if(data == "session expirée") {
                    alert(data);
                    window.location.href = "./index.php";
                }//else console.log(data);
            }
        });
    });


    $(window).on("load",function(){
        $.ajax({
            url:"http://localhost/BDE_Website/PHP_server/timeout.php",
            type:"GET",
            success: function(data,statut){
                if(data == "session expirée") {
                    alert(data);
                    window.location.href = "./index.php";
                }//else console.log(data);
            }
        });
    });

    //pour le t-ri par prix
    $('input[type=radio]').on('click', function(){

        $.ajax({
            url: "./PHP_server/productsTriprix.php",
            type: 'GET',
            data: 'contenu='+$(this).val(),
            dataType: 'html',
            success: function (data){
                console.log(data);
                $('.contain-products').html(data);
            }

        });
    });

    //Recherche par Mot clés

    $('#rech').on('keyup', function(){

    $.ajax({
            url:'./PHP_server/productKeyWord.php',
            type: 'GET',
            data: 'contenu='+$(this).val(),
            dataType: 'html',
            success: function (data){
                $('.contain-products').html(data);
                }   
  });

});

$('#rechbutton').on('click', function(e){
    e.preventDefault();
  
});


    //Le panier
    $('.produit button:not([data-target])').on('click', function(){
        var url_="http://localhost/BDE_Website/PHP_server/treat_order.php";

        $.ajax({
            url: url_,
            type: 'GET',
            data: 'prod-id='+$(this).attr('product-id') + '&user-id='+ $(this).attr('user-id') ,
            dataType: 'text',
            success: function (data){
                alert(data);

            }

        });


    });

    $('#content').on('click','i', function(){

               if(confirm("Etes-vous sur de vouloir supprimer ce produit?")){
                   var url_="http://localhost/BDE_Website/PHP_server/treat_order.php";

                   var datas = {
                       prodId : $(this).parent().attr('product-id'),
                       userId : $(this).parent().attr('user-id')
                   };

                   $.ajax({
                       url: url_,
                       type: 'DELETE',
                       data: JSON.stringify(datas),
                       dataType: 'text',
                       success: function (data){
                           $('#content').html(data);
                           var $input = $('input[type=number]');
                           var total = totalCart($input);

                           $('#totalprice').text(total);
                           //alert(data);
                       }

                   });
               }

    });

    $('input[type=number]').on('change', function(){

        var $input = $('input[type=number]');
        var total = totalCart($input);

        $('#totalprice').text(total);
    });

    function totalCart($input){

        var total = 0;

        for( var i=0; i<$input.length;i++){
            var qte = parseInt($input.eq(i).val());
            var price =parseInt($input.eq(i).parents('.prod-panier').find('.price-cart').text());
            total+= price*qte;
        }

        return total;

    }

    //supprimer un article
    $('.pbelle-table').on('click', function(){
        console.log($('.pbelle-table'));
        //alert('hoo');
        if(confirm('Voulez vous vraiment supprimer définitivement cet article ?')) {
            $.ajax({
                url:'./PHP_server/treat_admin.php',
                type: 'GET',
                data: 'contenu='+$(this).attr('prod-id'),
                dataType: 'html',
                success: function (data){
                    console.log(data);
                    $('#content-admin').html(data);
                }
            });
        }


    });





    // dropdown hover
    console.log("b");
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
     
    $(window).on("load resize", function() {
      if (this.matchMedia("(min-width: 808px)").matches) {
        $dropdown.hover(
          function() {
            const $this = $(this);
            $this.addClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "true");
            $this.find($dropdownMenu).addClass(showClass);
          },
          function() {
            const $this = $(this);
            $this.removeClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "false");
            $this.find($dropdownMenu).removeClass(showClass);
          }
        );
      } else {
        $dropdown.off("mouseenter mouseleave");
      }
    });


      //Affichage des commentaires

      url = "http://localhost/functions";
      function AjaxPost(url_,data_,type){
        $.ajax({
            url:url_,
            type:"POST",
            dataType:"text",
            data:data_,
            error: function(resultat,statut,erreur){
                      console.error(erreur);
                    },  
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
                    if(data == "done"){
                        window.location.href="./index.php";
                    }else{
                       $("#notFound").html("<div class='alert alert-danger' style='text-align:center'>"+data+"</div>");
                      // $(".dropdown-item[data-target='#connexionModal']").click();
                    }
                }
            } 
         });
    }






    



});