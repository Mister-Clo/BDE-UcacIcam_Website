<?php

function userPresentation(){
    if(isset($_SESSION["status"])) {

        if ($_SESSION["status"] != 2) {
            echo "<li><a class='dropdown-item' href='panier.php'><i class='fas fa-shopping-cart'></i>Mon panier</a></li>
          <div class='dropdown-divider'></div>";
        }
        echo "<li><a class='dropdown-item' href='logout.php'><i class='fas fa-power-off'></i>Deconnexion</a></li>";
        }else {
            echo "<li><a class='dropdown-item btn btn-default' data-toggle='modal' data-target='#connexionModal'>Connexion</a></li>
        <div class='dropdown-divider'></div>
        <li><a class='dropdown-item' href='registration.php'>Inscription</a></li>";
        }
}

//Posts
function displayPosts($idEvent){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $posts=[];
  $i=0;
  $Postlist = $BDD->prepare("SELECT * FROM EventsPosts inner join bde_national.users on eventsposts.id_users = bde_national.users.id WHERE Id_Events=?");
  $Postlist->execute(array($idEvent));

   while($post= $Postlist->fetch()){

       $likes = $BDD->prepare("SELECT COUNT(*) as nb FROM eventsposts inner join likes on eventsposts.Id = likes.Id_posts  where Likes.Id_posts=? GROUP BY Id_posts");
       $likes->execute(array($post["Id"]));
       $likes = $likes->fetch();

      echo "<div class=\"post\">
          <div class='post-header'>
            <div>
              <div class=\"post-maker\">".ucfirst($post["name"])." ".ucfirst($post["surname"])."</div>
              <div class=\"post-time\">".$post["Created_At"]."</div>
            </div>";
      if(isset ($_SESSION["status"])){
          if($_SESSION["status"] == 2){
             echo "<div><a href='".$post["URLImage"]."' download='".$post["URLImage"]."' title=\" Télécharger l'image \"><i class='fas fa-download'></i></a></div>";
          }
      }
   echo    "</div>
           <div class=\"post-description\">".$post["Description"]."</div>
          
       
       
           <div class=\"post-image\">
             <img src=\"".$post["URLImage"]."\" style=\"width:100%; height: 60%\"/>
          </div>
          <div class=\"post-likes\">";

       if(isset($_SESSION["status"])) {

       $nb = $BDD->prepare("select COUNT(*) as nb from likes where Id_Users = ? and Id_posts=?");
       $nb->execute(array($_SESSION["id"],$post['Id']));
       $nb = $nb->fetch();

              if($nb["nb"] == 0)  {echo "<i class=\"far fa-heart\" token-user='" . $_SESSION["token"] . "' id-post='" . $post["Id"] . "' id-user='" . $_SESSION['id'] . "'></i>";}
               else {echo "<i style='color:red' class=\"fas fa-heart\" token-user='" . $_SESSION["token"] . "' id-post='" . $post["Id"] . "' id-user='" . $_SESSION['id'] . "'></i>";}
          }

         echo  "<i class=\"far fa-comment-alt\" data-toggle='modal' data-target='#commentModal' id-eventsposts='".$post["Id"]."' id-event='".$idEvent."'></i>
          </div>
          <div style=\"text-align:left\">Aimé par ";
          echo "<span>".($likes['nb']!="" ? $likes['nb'] : 0)."</span>";
       echo " personnes</div>
      </div>";
  }
}

function savePost($post){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $events=[];
    $i=0;
    $req = $BDD->prepare('insert INTO eventsposts(Description,URLImage,Created_At,Id_Users,Id_Events) VALUES(:description, :urlimage, now(), :id_users, :id_events)');

    $req->bindValue(':description', $post['description'], PDO::PARAM_STR);
    $req->bindValue(':urlimage', $post['urlimage'], PDO::PARAM_STR);
    $req->bindValue(':id_users', $post['id_user'], PDO::PARAM_INT);
    $req->bindValue(':id_events', $post['id_event'], PDO::PARAM_INT);

    $res = $req->execute();

    return $res;
}

function deletePost($product_name){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $res = $BDD->exec("delete FROM produits WHERE Name = '".$product_name."'");

    return $res;
}

//commmentaires
function displayComments($idPost){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $comments=[];
  $i=0;
  $CommentsList = $BDD->prepare("SELECT * FROM `comments` inner join bde_national.users on bde_national.users.id=comments.Id_Users WHERE comments.Id_EventsPosts=? order by comments.Date");
  $CommentsList->execute(array($idPost));

  while($donnees= $CommentsList->fetch()){
      $comments[$i]=$donnees;
      $i++;
  }

  foreach($comments as $comment) {
      echo
      "<div class='comment'>
     <div class='comment-body'>
       <div class='comment-name'>".ucfirst($comment["name"])." ".ucfirst($comment["surname"])."</div>
       <div class='comment-message'>
         ".$comment["Message"]."
       </div>
     </div>
     <div class='comment-time'>".$comment["Date"]."</div>
   </div>";
  }
}

function saveComment($comment){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $comments=[];
    $i=0;
    $req = $BDD->prepare('insert INTO comments(Date,Message,Id_Users,Id_EventsPosts) VALUES(now(), :message, :id_user, :id_eventsposts)');

    $req->bindValue(':message', $comment['message'], PDO::PARAM_STR);
    $req->bindValue(':id_user', $comment['id_user'], PDO::PARAM_INT);
    $req->bindValue(':id_eventsposts', $comment['id_eventsposts'], PDO::PARAM_INT);

    $res = $req->execute();

    return $res;
}

//Evenements
function displayPastEvents(){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $events=[];
    $donnees=[];
  $i=0;
     $EventList = $BDD->query('SELECT * FROM `events` WHERE  Date < NOW()');

  while ($donnees = $EventList->fetch()) {
            $events[$i]=$donnees;
            $i++;
  }

  foreach ($events as $event){
      echo "<div class='Event'>
                  <a class='TitleEvent' href='posts.php?idevent=".$event["Id"]."'><h3>".$event["Name"]."</h3>
                   <p class='EventDate'>".$event["Date"]."</p>
                   <div class='EventImage'>
                     <img style='width:100%; height: 60%' class='EventThumbnail' src='".$event["URLImage"]."'/>
                   </div></a>
                   <p class='EventText'>".$event["Description"]."</p>
                 </div>";
  }

}

function displayFutureEvents(){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $events=[];
    $donnees=[];
    $i=0;

        $EventList = $BDD->query('SELECT * FROM `events` WHERE  Date > NOW()');

    while ($donnees = $EventList->fetch()) {
        $events[$i]=$donnees;
        $i++;
    }

    foreach ($events as $event){

        echo "<div class='Event'>";
        if(isset($_SESSION["status"])){
            if($_SESSION["status"]==2){
                echo "<div class='croix'><i class='fas fa-times' title='En tant que sala'></i></div>";
            }
        }
             echo "<h3>".$event["Name"]."  </h3>
                   <p class='EventDate'>".$event["Date"]."</p>
                   <div class='EventImage'>
                     <img style='width:100%; height: 60%' class='EventThumbnail' src='".$event["URLImage"]."'/>
                   </div>
                   <p class='EventText'>".$event["Description"]."</p>";

            if(isset($_SESSION["status"])){
                if($_SESSION["status"] == 0){
                    echo  "<i class='fas fa-plus-circle' style='display: inline-block' title='Inscrivez vous à cet évènement' id-event='".$event["Id"]."' id-user='".$_SESSION["id"]."' token-user='".$_SESSION["token"]."'></i>
                 </div>";
                }else if($_SESSION["status"] == 1){
                    echo "<i class='fas fa-plus-circle' style='display: inline-block' title='Inscrivez vous à cet évènement' id-event='".$event["Id"]."' id-user='".$_SESSION["id"]."' token-user='".$_SESSION["token"]."'></i>
                          <div> 
                          <a href='http://localhost/BDE_Website/PHP_server/others.php/liste_des_inscrits_pdf?idevent=".$event["Id"]."'><i class='far fa-file-pdf file_' title='Télécharger la liste des inscrits en format PDF'></i> </a>
                          <a href='http://localhost/BDE_Website/PHP_server/others.php/liste_des_inscrits_csv?idevent=".$event["Id"]."'><i class='fas fa-file-csv file_' title='Télécharger la liste des inscrits en format CSV' id-event='".$event["Id"]."'></i></a>
                          </div>
                       </div>";
                }else echo "</div>";
            }else{
                echo "</div>";
             }
    }

}

function saveEvent($event){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $events=[];
    $i=0;
    $req = $BDD->prepare('insert INTO events(Name,Description,URLImage,Date,Id_Users) VALUES(:nom, :description, :urlimage, :date, :id_user)');

    $req->bindValue(':description', $event['description'], PDO::PARAM_STR);
    $req->bindValue(':urlimage', $event['urlimage'], PDO::PARAM_STR);
    $req->bindValue(':id_user', $event['id_user'], PDO::PARAM_INT);
    $req->bindValue(':nom', $event['nom'], PDO::PARAM_STR);
    $req->bindValue(':date', $event['date'], PDO::PARAM_STR);

    $res = $req->execute();

    return $res;
}


function registerUser($input){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $req = $BDD->prepare('insert INTO participate(Id_Users,Id_Events) VALUES(:id_user, :id_event)');

    $req->bindValue(':id_user', $input->idUser, PDO::PARAM_INT);
    $req->bindValue(':id_event', $input->idEvent, PDO::PARAM_INT);

    $res = $req->execute();

    return $res;
}

//La liste des inscrits à un évènement
function listeDesInscrits($idevent){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $inscrits=[];
    $i=0;

    $EventList = $BDD->query('SELECT participate.Id_Events,bde_national.users.name,bde_national.users.surname,bde_national.users.email  FROM participate inner JOIN bde_national.users on participate.Id_Users = bde_national.users.id where participate.id_Events='.$idevent);

    while ($donnees = $EventList->fetch()) {
        $inscrits[$i]=$donnees;
        $i++;
    }

    return $inscrits;
}

//Likes
function registerLike($input){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $req = $BDD->prepare('insert INTO likes(Id_Posts,Id_Users) VALUES(:id_post,:id_user)');

    $req->bindValue(':id_post', $input->idPost, PDO::PARAM_INT);
    $req->bindValue(':id_user', $input->idUser, PDO::PARAM_INT);

    $res = $req->execute();

    return $res;
}

//Produits
function displayProducts($category){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $products=[];
    $i=0;
    $ProductList = $BDD->prepare('SELECT * FROM `products` WHERE  Category=?');
    $ProductList->execute(array($category));

    while ($product = $ProductList->fetch()) {
        echo " <div class='produit'>
      <p>".$product["Name"]."<br/><span class='prix'>".$product["Price"]." FCFA</span></p>
      <div>
      <img src='".$product["URLImage"]."' alt='".$product["Name"]."' title='".$product["Description"]."'>
    </div>";

        echo isset($_SESSION["status"])? " <button type='button' class='btn btn-secondary btn-lg btn-block' product-id ='".$product["Id"]."' user-id ='".$_SESSION["id"]."' >Ajouter au Panier <i class='fas fa-shopping-cart'></i></button>" : "<button type='button' class='btn btn-dark btn-lg btn-block' data-toggle='modal' data-target='#connexionModal'>Ajouter au Panier <i class='fas fa-shopping-cart'></i></button>";

        echo "</div>";

        $i++;
    }

}

function saveProducts($products){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $events=[];
    $i=0;
    $req = $BDD->prepare('insert INTO produits(Name,URLImage,Category,Price) VALUES(:name, :urlimage, :category, :price)');

    $req->bindValue(':name', $products['name'], PDO::PARAM_STR);
    $req->bindValue(':urlimage', $products['urlimage'], PDO::PARAM_STR);
    $req->bindValue(':category', $products['category'], PDO::PARAM_STR);
    $req->bindValue(':price', $products['price'], PDO::PARAM_INT);

    $res = $req->execute();

    return $res;
}

function deleteProducts($product_name){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $res = $BDD->exec("delete FROM produits WHERE Name = '".$product_name."'");

    return $res;
}

function updateProductQte($product_id,$qte){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $res = $BDD->exec("UPDATE products SET Quantity = Quantity - ".$qte." WHERE Id =".$product_id);

    return $res;
}

//Panier
function displayCart($user_id){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $CartList = $BDD->prepare("SELECT * FROM `paniers` JOIN `products` ON paniers.Id_Products = products.Id WHERE paniers.Id_Users = ?");
    $i=0;
    $price=0;

    $CartList->execute(array($user_id));
    while ($cart = $CartList->fetch()){
        $price+=intval($cart["Price"]);
        $i++;
        echo "<div class='prod-panier'>
      <div class='img-prod'><img width='30%' height='100%' src='".$cart["URLImage"]."'></div>
      <div class='prod-name'>
         <span>".$cart["Name"]."</span><br>                    
         <span class='price-cart'>".$cart["Price"]."</span>FCFA
      </div>
      <form method='post' action='#'>
        <label for='qty'> Qty: </label><input min='1' max='19' type='number' value='1' focus/><br/> 
        </form>

      <div class='pbelle' product-id ='".$cart["Id"]."' user-id ='".$user_id."' ><i class='fas fa-trash-alt'></i></div>
    </div>";
    }

    $tab = array(
        'nb' => $i,
        'price' => $price
    );

    return $tab;
}

function addInCart($prod_id,$user_id ){

    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $cartprod = $BDD->prepare("INSERT INTO paniers(Id_Products,Id_Users) VALUES(?,?)");
    $i = $cartprod->execute(array($prod_id,$user_id));

    return $i;
}

function deleteFromCart($prod_id,$user_id){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $cartprod = $BDD->prepare("DELETE FROM paniers WHERE Id_Products = ? AND Id_Users = ?");
    $i = $cartprod->execute(array($prod_id,$user_id));
    return $i;
}

function cleanCart($user_id){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $cartprod = $BDD->prepare("DELETE FROM paniers WHERE Id_Users = ?");
    $i = $cartprod->execute(array($user_id));
    return $i;
}

//Commandes
function addOrder($price,$user_id){

    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $cartprod = $BDD->prepare("INSERT INTO orders(Date,Price,Id_Users) VALUES(now(),?,?)");
    $i = $cartprod->execute(array($price,$user_id));

    return $i;
}

// Table d'administration des produits
function tableProducts(){
    $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $ProdList = $BDD->query("SELECT * FROM `products`", PDO::FETCH_ASSOC);

    $tabbody= "";
    $tabhead= " <h2>TOUS LES PRODUITS </h2>
  <table id='table_id' class='display' border='1'>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>URLImage</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>";
    $tabfoot= "</tbody>
            </table>";

    foreach($ProdList as $donnees){

        $tabbody.= "<tr>

            <td>".$donnees["Id"]."</td>
            <td>".$donnees["Name"]."</td>
            <td>".$donnees["Description"]."</td>
            <td>".$donnees["URLImage"]."</td>
            <td>".$donnees["Category"]."</td>
            <td>".$donnees["Price"]."</td>
            <td>".$donnees["Quantity"]."</td>
            <td><i  prod-id='".$donnees["Id"]."'  class='fas fa-trash-alt pbelle-table'></i></td>
          </tr>" ;
    }

    $ProdList->closeCursor();
    $tabbody.=$tabfoot;
    $tabhead.= $tabbody;

    echo $tabhead;

}


?>