jQuery(function($){

    //s'inscrire à un évènement
    $("#EvenementListe .fa-plus-circle").on("click",function(){

                if(confirm("En cliquant sur OK vous vous inscrirez à cette activité")) {
                    let url_event = "http://localhost/BDE_Website/PHP_server/treat_events.php/inscription";
                    let data = {};
                    data.idUser = $(this).attr("id-user");
                    data.idEvent = $(this).attr("id-event");
                    data.tokenUser = $(this).attr("token-user");

                    Ajax(url_event, JSON.stringify(data), 'POST', function (data) {
                        alert(data);
                        //alert("inscription réussie");
                    });
                }

    });

    //Télécharger toutes les images
    $(".downloadImages").on("click",function(e){
        e.preventDefault();

        let url_ = "http://localhost/BDE_Website/PHP_server/others.php/toutes_les_images";
        Ajax(url_, '', 'GET',function (data) {
            window.location.href=data;
        });

    });

    //Télécharger la liste des inscrits en csv
     $(".fa-file-csv").on("click",function (e) {
         e.preventDefault();
         let idevent = $(this).attr("id-event");
          let url="http://localhost/BDE_Website/PHP_server/others.php/liste_des_inscrits_csv";
          Ajax(url,"&idevent="+idevent,'GET',function(data){
            alert(data);
              window.location.href=data;
          });
      });

    //Les likes
    $(".post-likes .fa-heart").on("click",function(){
        let that = $(this);
        let url_event = "http://localhost/BDE_Website/PHP_server/others.php/likes";
        let data = {};
        data.idUser= $(this).attr("id-user");
        data.idPost= $(this).attr("id-post");
        data.tokenUser= $(this).attr("token-user");

        Ajax(url_event,JSON.stringify(data),'POST',function(data){

            if(data != "non"){
                that.parent().next().children("span").text(data);

                //Animation
                that.animate({fontSize: "2.3em"},120)
                    .animate({fontSize: "2em"},120)
                    .animate({fontSize: "2.1em"},100)
                    .animate({fontSize: "2em"},100);

                that.removeClass('far');
                that.addClass('fas');
                that.css({color:"red"});
            }
        });



    });


    $("#buttonValidation").on('click',function(){

        if(parseInt($("#totalprice").text()) != 0) {

            if (confirm("Valider votre achat en cliquant sur OK")) {
                var data = {};
                data.prixTotal = parseInt($("#totalprice").text());
                data.token = $(this).attr("token-user");
                data.produits = [];

                for (let i = 0; i < $(".prod-panier").length; i++) {

                    let product = $(".prod-panier").eq(i);
                    data.produits[i] = {};
                    data.produits[i].prix = product.find('.price-cart').text();
                    data.produits[i].id = product.find('.pbelle').attr("product-id");
                    data.produits[i].qte = product.find("input[type='number']").val();
                }

                let url = "http://localhost/BDE_Website/PHP_server/treat_transactions.php";
                Ajax(url, JSON.stringify(data), 'POST', function (data) {
                    alert(data);
                    window.location.href="./panier.php";
                });
            }


        }else{
            alert("Votre panier est vide. Allez à la boutique pour faire des achats");
        }

    });
    
    $(".validerIdee").on("click",function () {
        $(".modal-body #prodname").val($(this).attr('user-email'));
        $(".modal-body #proddescrip").val($(this).parent().find('.IdeeContent').text());
    });




    function AjaxPost(url_, data_,success) {        $.ajax({
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