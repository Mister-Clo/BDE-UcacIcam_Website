<?php
include '../functions.php'; 


$method= $_SERVER["REQUEST_METHOD"];

if($method == "GET"){
$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_GET['prod-id']) && isset($_GET['user-id'])){

$result = addInCart(htmlspecialchars($_GET['prod-id']),htmlspecialchars($_GET['user-id']));

	if ($result!=0) {
		echo "Article ajouté avec succès";
	}

	else{
		echo "Article déjà présent dans votre panier";
	}
}

}

else if($method == "DELETE"){
	$input = json_decode(file_get_contents('php://input'), true);

$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($input['prodId']) && isset($input['userId'])){

$result = deleteFromCart(htmlspecialchars($input['prodId']),htmlspecialchars($input['userId']));
displayCart($input['userId']);

	/*if ($result!=0) {
		echo "Article ajouté avec succès";
 	}*/
 }
}

?>