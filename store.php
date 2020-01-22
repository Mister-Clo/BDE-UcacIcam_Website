
	 <?php  include('header.php'); ?>
     <div id="recherche" class="fixed-top ">
        <ul id="small-catalogue">
             <li><i class="fas fa-cocktail"></i><a href="#nosboissons">Boissons</a></li>
             <li><i class="fas fa-hamburger"></i><a href="#nosaliments">Aliments</a></li>
             <li><i class="fas fa-tshirt"></i><a href="#nosgoodies">Goodies</a></li>
         </ul>

         <div id="small-tri" class="dropdown">
          <div class="btn-group">
          <button class="btn btn-warning btn-sm" type="button">Tri par prix</button>
        <button class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <form method="post" action="#">
        <input type="radio" name="triprix" value="all" /> <label for="all"> Tous les articles</label><br/>
            
        <input type="radio" name="triprix" value="1k"  /> <label for="1k"> 500 à 1000FCFA </label><br/>

        <input type="radio" name="triprix" value="3k" /> <label for="3k"> 1100 à 3000FCFA</label><br/>

        <input type="radio" name="triprix" value="plus3k" /> <label for="high"> plus de 3000FCFA</label><br/>

        </form>
        </div>
        </div>
</div>
         <form class="form-inline">
            <input id="rech" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button id="rechbutton" class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
        </form> 
     </div>
      
<div class="content">

     <aside class="col-md-2 col-sm-6" id="catalogue" >
         <h3>Catalogue</h3>
         <hr/>
         <ul>
             <li><i class="fas fa-cocktail"></i><a href="#nosboissons">Boissons</a></li>
             <li><i class="fas fa-hamburger"></i><a href="#nosaliments">Aliments</a></li>
             <li><i class="fas fa-tshirt"></i><a href="#nosgoodies">Goodies</a></li>
         </ul>
     </aside>
      <div class="bd-example col-sm-11" >
        <h3><i class="fas fa-star"></i>Nos Meilleures ventes</h3>
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active" data-interval="3000">
                <img height="550px" src="./assets/images/produits/canette-coca.webp" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>coca-cola canette</h5>
                  <p>Boisson rafraîchissante gazeuse non alcoolisée.</p>
                </div>
              </div>
              <div class="carousel-item" data-interval="3000">
                <img height="550px" src="./assets/images/produits/sardine.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>sardines</h5>
                  <p>Elles sont assaisonées au citron.</p>
                </div>
              </div>
              <div class="carousel-item" data-interval="3000">
                <img height="550px" src="./assets/images/produits/orangina-big.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>orangina_grand</h5>
                  <p>Boisson rafraîchissante gazeuse non alcoolisée faite avec des oranges.</p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div> 
        <div class="contain-products">
          <div id="boissons">
            <h3 id="nosboissons">Nos Boissons</h3>
            <?php displayProducts('boissons'); ?>
    </div>

    <div id="aliments">
          <h3 id="nosaliments">Nos Denrées alimentaires </h3>
          <?php displayProducts('aliments'); ?>
    </div>

    <div id="goodies">
            <h3 id="nosgoodies">Nos Goodies</h3>
            <?php displayProducts('goodies'); ?>
    </div>
          
  </div>
        
 </div>
    <aside class="col-md-2 col-sm-6" id="trier">
       
         <h3>Trier par prix : </h3>
         <hr>
         <form method="post" action="#">
        <input type="radio" name="triprix" value="all" class="option-input radio"  /> <label for="all"> Tous les articles</label><br/>
            
        <input type="radio" name="triprix" value="1k" class="option-input radio"  /> <label for="1k"> 500 à 1000FCFA </label><br/>

        <input type="radio" name="triprix" value="3k" class="option-input radio" /> <label for="3k"> 1100 à 3000FCFA</label><br/>

        <input type="radio" name="triprix" value="plus3k" class="option-input radio" /> <label for="high"> plus de 3000FCFA</label><br/>

        </form>
     </aside>
</div>


	 <?php include('footer.php'); ?>