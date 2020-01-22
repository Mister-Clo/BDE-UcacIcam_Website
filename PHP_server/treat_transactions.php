<?php
session_start();
include '../functions.php';



$input = json_decode(file_get_contents('php://input'), true);

if(isset($_SESSION['token'])){
    if($input["token"] == $_SESSION["token"]){

        $bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $paid = true;

        if($paid){
            if(addOrder($input["prixTotal"],$_SESSION["id"])){
             if(cleanCart($_SESSION['id'])){
                 $produits = $input["produits"];
                 foreach($produits as $produit){
                     updateProductQte($produit["id"],$produit["qte"]);
                 }
                 echo "Transaction effectuée";
             }
            }
        }

    }
}



?>
