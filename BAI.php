<?php include('header.php');

	function ShowActivities() {
		
	echo('<div class="ideavote">
		<h3 class="BAIh3" >Liste Des Suggestions</h3>');
		
		$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		$ActivitesList = $bdd->prepare("
			SELECT ideas.id,Activity,Surname,Name,COUNT(votes.Id_Users),Email
			FROM ideas
			INNER JOIN bde_national.users ON bde_national.users.id = ideas.IDUser
			INNER JOIN votes ON ideas.id = votes.Id_Ideas
			GROUP BY votes.ID_Ideas
			
			");
			
		$ActivitesList->execute();
		
		
		foreach($ActivitesList as $ans){
			echo '<div class="vote_">';
				echo "<p class='IdeeName'>".strtoupper($ans[3])." ".$ans[2]."</p>";
				echo "<p class='IdeeContent'>".$ans[1]."</p>";
				
					
					echo "<p class='IdeeVotes'>Déjà ".$ans[4]." vote(s) !</p>";
            if($_SESSION['status']==1){
                echo "<button type='button' user-email='".$ans[5]."' user-idea='".$ans[1]."' class='btn btn-warning buttonBAI validerIdee' data-toggle='modal' data-target='#sendmail'>
  <i class='fas fa-plus-circle'></i>Valider
</button>
";
            }


            echo("<form method='get' action='./PHP_server/scriptVote.php'>");
            echo("<input type='text' name='token' value='".$_SESSION['token']."' style='display:none;'/>");
            echo("<input type='text' name='idea' value='".$ans[0]."' style='display:none;'/>");
					echo("<button type='submit' class='votefor buttonBAI'>Voter <i class='fas fa-thumbs-up'></i></button></form>");
				
			echo ('</div>');
		}
	echo ('</div>');
	}
	
	function ShowForm() {
		
			echo ('<div class="proposition">
					<h3 class="BAIh3" >Proposer une activité</h3>
					<form  method="post" action="./PHP_server/scriptProposition.php" autocomplete="on">');

          echo ("<input type='hidden' name='token' value='".$_SESSION['token']."' />");

					echo ('<p>
					<textarea name="Activity" class="Activity_text" required="required" rows="5" placeholder="Décrivez votre activité"></textarea>
					</p>
					<p class="Confirm button"> 
					<button id="propose" type="submit">Soumettre ma proposition</button>
					</p>
					
					</form>
					</div>');

	}
	
	?>
    <!-- Modal -->
    <div class="modal fade" id="sendmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title login100-form-title p-b-32" id="exampleModalCenterTitle">ENVOI DE MAIL<i class='fas fa-envelope'></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="./PHP_server/send.php" autocomplete="on">

                        <div class="form-group">
                            <label for="artname" >Á: </label>
                            <input id="prodname" class="form-control" name="email" required="required" type="email" placeholder=""/>
                        </div>
                        <div class="form-group">
                            <label for="artdescrip" >Message: </label>
                            <input id="proddescrip" class="form-control" name="message" required="required" type="text" aria-describedby="descripHelp" placeholder=""/>
                            <small id="descripHelp" class="form-text text-muted">La politique de confidentialité est notre priorité et seul le destinataire accedera au présent maiil🛂.</small>
                        </div>


                        <button type="submit" class="btn btn-outline-success">Envoyer</button>

                    </form>

                </div>
            </div>
        </div>
    </div>



    <section id="BoiteAIdees">
	<div id="banniere">	
		<h2>Boîte à idées</h2>
	</div>

	
	<div id="sectionidees">

		<?php if(isset($_SESSION['status'])){
			if ($_SESSION['status']==0){
				ShowForm();
				ShowActivities();

			}
			else if($_SESSION['status']==1){
				ShowActivities();

			}
			else if($_SESSION['status']==2){
				ShowActivities();
			}

			
		} else{echo "<p class='disconnected'>Vous devez être connecté pour pouvoir participer ou proposer une idée</p>";} ?>

	</div>
</section>

<?php include('footer.php'); ?>