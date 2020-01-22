<?php

	session_start();
	//Requête insertion du vote	/ vote insertion

if(isset($_SESSION['token'])){
    if($_GET["token"] == $_SESSION['token']){

        $IDIdea = $_GET['idea'];
        $IDUser = $_SESSION['id'];

        $bdd1 = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $requete2 = $bdd1->prepare("INSERT INTO Votes (Id_Users, Id_Ideas) VALUES( :IDUser, :IDIdea) ");
        $requete2->bindValue(':IDUser', $IDUser, PDO::PARAM_INT);
        $requete2->bindValue(':IDIdea', $IDIdea, PDO::PARAM_INT);
        $requete2->execute();

        /*echo '<meta http-equiv="refresh" content="0;URL=../BAI.php">';*/

        header("location:../BAI.php" );
    }
}

				
?>