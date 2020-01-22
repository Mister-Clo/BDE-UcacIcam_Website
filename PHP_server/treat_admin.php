<?php
include '../functions.php'; 

$method= $_SERVER["REQUEST_METHOD"];
$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if($method == "GET"){
	if (isset($_GET['contenu'])){

	$req = $bdd->prepare("DELETE FROM `products` WHERE Id= ?");
	$req->execute(array(htmlspecialchars($_GET['contenu'])));
    
    echo tableProducts();
		}
}

elseif ($method == "POST") {
	$prodname = $_POST['prodname'];
	$proddescrip = $_POST['proddescrip'];
	$prodimage = $_POST['prodimage'];
	$prodcat = $_POST['prodcat'];
	$prodprice = $_POST['prodprice'];


	// Requête préparée pour ajouter un produit
$req = $bdd->prepare('INSERT INTO products (Name,Description,URLImage,Category, Price) VALUES(:name, :descrip, :urlim, :cat, :price)');
$req->bindValue(':name',$prodname, PDO::PARAM_STR);
$req->bindValue(':descrip',$proddescrip, PDO::PARAM_STR);
$req->bindValue(':urlim',$prodimage, PDO::PARAM_STR);
$req->bindValue(':cat',$prodcat, PDO::PARAM_STR);
$req->bindValue(':price',$prodprice, PDO::PARAM_INT);
$req->execute();
header("location:../administration.php");
$req->closeCursor();

}

?>

