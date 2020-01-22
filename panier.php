<?php include('header.php'); 
  
  if (!isset($_SESSION["status"])) {
#redirection vers la page d'accueil
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
  }
  else if($_SESSION["status"]==2){
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
  }
  else{
?>
  


<h3 class="panier">Mon Panier <img width="5%" height="3%" src="./assets/images/autres/goods.png" alt="panier"></h3>
<div id="main-panier" >
	<div id="content">
<?php 
 $cart= displayCart($_SESSION["id"]); 

   if ($cart['nb']==0) {
     echo "Manque d'inspiration ? Votre panier semble vide 😥";
   }
 ?>   

 </div>

 <div id="payment">
 	<h5>TOTAL : <span id="totalprice">
    <?php  echo $cart['price'] ?>
      </span> FCFA</h5><br>
 	<button type="button" class="btn btn-success" id="buttonValidation" token-user= <?php echo $_SESSION['token'] ?> >Valider l'achat</button><hr>
 	<h5>NOUS ACCEPTONS :</h5>
 	<a href="#"><img width="30%" height="20%" src="./assets/images/autres/paypal.png" alt="paypal"></a>
 </div>

</div>
<?php 
}
  include('footer.php'); ?>