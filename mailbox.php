<?php include('header.php');
 ?>

<div class="boiteMail">
    <p class='IdeeName'>BOITE DE RECEPTION<i class='fas fa-envelope'></i></p>

<?php 

		if(isset($_SESSION['id'])){
            $bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            $ActivitesList = $bdd->prepare("SELECT message from mail where id_user=? ");
            $ActivitesList->bindValue(1,$_SESSION['id'], PDO::PARAM_INT);
            $ActivitesList->execute();

            foreach($ActivitesList as $ans){
                echo "<p class='IdeeContent'>".$ans[0]." a été retenu</p>";
            }

        }
?>
</div>

<?php
	include('footer.php');
?>

