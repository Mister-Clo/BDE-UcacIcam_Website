<?php include('header.php');
if (!isset($_SESSION["status"])) {
#redirection vers la page d'accueil
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
  }
  else if($_SESSION["status"]!=1){
    echo "<meta http-equiv='refresh' content='0;URL=index.php'>";
  }
  else{

?>

<div id="content-admin">
	<?php tableProducts();?>
</div>

<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ajouterProduitModal">
  <i class="fas fa-plus-circle"></i>AJOUTER UN PRODUIT
</button>

     <!-- Modal -->
<div class="modal fade" id="ajouterProduitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title login100-form-title p-b-32" id="exampleModalCenterTitle">AJOUTER UN PRODUIT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="./PHP_server/treat_admin.php" autocomplete="on">
	
    <div class="form-group"> 
        <label for="artname" > Name : </label>
        <input id="prodname" class="form-control" name="prodname" required="required" type="text" placeholder=""/>
    </div>
    <div class="form-group"> 
        <label for="artdescrip" > Description : </label>
        <input id="proddescrip" class="form-control" name="proddescrip" required="required" type="text" aria-describedby="descripHelp" placeholder=""/>
        <small id="descripHelp" class="form-text text-muted">Pas de long discours.Une brève description suffira.</small>
    </div>
    <div class="form-group"> 

        <label for="prodimage" > URLImage : </label>
        <input id="prodimage" class="form-control" name="prodimage" required="required" type="text" placeholder=""/>
    </div>
		<div class="form-group">  
        <label for="prodcat" > Category : </label>
            <select name="prodcat" required="required" id="prodcat" class="form-control">
                <option value="goodies" class="form-control">goodies</option>
                <option value="aliments" class="form-control">aliments</option>
                <option value="boissons" class="form-control">boissons</option>
            </select>
       <!-- <input id="prodcat" class="form-control" name="prodcat" required="required" type="text" placeholder=""/> -->
    </div>
	<div class="form-group"> 
        <label for="prodprice" > Price : </label>
        <input id="prodprice" class="form-control" name="prodprice" required="required" type="number" value="500" min='500' max='5000'placeholder=""/>
    </div>

    <button type="submit" class="btn btn-outline-success">AJOUTER</button>

     </form>

      </div>
    </div>
  </div>
</div>


<?php
	}
 include('footer.php'); ?>