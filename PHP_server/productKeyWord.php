<?php

$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

if (isset($_GET['contenu'])){
	$nosboissons="";
		$startboissons= "<div id='boissons'>
                <h3 id='nosboissons'>Nos Boissons</h3>";
        $endboissons= "</div>";
      $boissons = $bdd->prepare("SELECT * FROM `products` WHERE  Name LIKE ? AND Category='boissons' ");
      $boissons->execute(array("%$_GET[contenu]%"));
      foreach ($boissons as $boisson) {
			$nosboissons.=" <div class='produit'>
					      <p>".$boisson["Name"]."<br/><span class='prix'>".$boisson["Price"]." FCFA</span></p>
					      <div>
					      <img src='".$boisson["URLImage"]."' alt='".$boisson["Name"]."' title='".$boisson["Description"]."'>
					    </div>";
					    if (isset($_SESSION["status"])) {
					    	$nosboissons.= "<button type='button' class='btn btn-secondary btn-lg btn-block'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button>
					    </div>";
					    }
					    else{
					    	$nosboissons.="<button type='button' class='btn btn-secondary btn-lg btn-block' data-toggle='modal' data-target='#connexionModal'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button></div>";
					    }
					     

	}

	$boissons->closeCursor();
	$nosboissons.=$endboissons;
    $startboissons.= $nosboissons;//les boissons

    $nosaliments="";
		$startaliments= "<div id='aliments'>
          <h3 id='nosaliments'>Nos Denrées alimentaires </h3>";
        $endaliments= "</div>";
        $aliments = $bdd->prepare("SELECT * FROM `products` WHERE  Name LIKE ? AND Category='aliments' ");
       $aliments->execute(array("%$_GET[contenu]%"));
        foreach ($aliments as $aliment) {
			$nosaliments.=" <div class='produit'>
					      <p>".$aliment["Name"]."<br/><span class='prix'>".$aliment["Price"]." FCFA</span></p>
					      <div>
					      <img src='".$aliment["URLImage"]."' alt='".$aliment["Name"]."' title='".$aliment["Description"]."'>
					    </div>";
					    if (isset($_SESSION["status"])) {
					    	$nosaliments.= "<button type='button' class='btn btn-secondary btn-lg btn-block'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button>
					    </div>";
					    }
					    else{
					    	$nosaliments.="<button type='button' class='btn btn-secondary btn-lg btn-block' data-toggle='modal' data-target='#connexionModal'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button></div>";
					    }
					    

	}
	$aliments->closeCursor();
	$nosaliments.= $endaliments;
	$startaliments.= $nosaliments;//les aliments

	$nosgoodies="";
		$startgoodies= "<div id='goodies'>
            <h3 id='nosgoodies'>Nos Goodies</h3>";
        $endgoodies= "</div>";
        $goodies = $bdd->prepare("SELECT * FROM `products` WHERE  Name LIKE ? AND Category='goodies' ");
        $goodies->execute(array("%$_GET[contenu]%"));
        foreach ($goodies as $goody) {
			$nosgoodies.=" <div class='produit'>
					      <p>".$goody["Name"]."<br/><span class='prix'>".$goody["Price"]." FCFA</span></p>
					      <div>
					      <img src='".$goody["URLImage"]."' alt='".$goody["Name"]."' title='".$goody["Description"]."'>
					    </div>";
					    if (isset($_SESSION["status"])) {
					    	$nosgoodies.= "<button type='button' class='btn btn-secondary btn-lg btn-block'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button>
					    </div>";
					    }
					    else{
					    	$nosgoodies.="<button type='button' class='btn btn-secondary btn-lg btn-block' data-toggle='modal' data-target='#connexionModal'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button></div>";
					    }
					     

	}
	$goodies->closeCursor();
	$nosgoodies.= $endgoodies;
	$startgoodies.= $nosgoodies;//les goodies

	$data= $startboissons.$startaliments.$startgoodies;
	echo $data;

}