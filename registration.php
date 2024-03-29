<?php include('header.php'); ?>
     
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login101 m-b-10">
			<div class="zone">
			<form class="login100-form inscription-form">
					<div class="login100-form-title p-b-26">
                    <img class="logo rounded-circle img-thumbnail" src="./assets/images/autres/bde1.jpg" alt="Logo du BDE" title="logo du BDE" width="45%" height="45%" class="d-inline-block align-top">
                    </div>
                    <div class="login100-form-title p-b-32">Inscription</div>  
            
                  
                  <div class="wrap-input100 validate-input" data-validate = "Entrez le nom">
						<input class="input100" type="text" name="nom_inscription">
						<span class="focus-input100" data-placeholder="Nom"></span>	
					</div>
                    <div class="nom_error input-error"></div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Entrez le prénom">
						<input class="input100" type="text" name="prenom_inscription">
						<span class="focus-input100" data-placeholder="Prenom"></span>	
					</div>
                    <div class="prenom_error input-error"></div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Entrez l'email">
						<input class="input100" type="email" name="email_inscription">
						<span class="focus-input100" data-placeholder="Email"></span>	
					</div>
                    <div class="email_error input-error"></div>


                    <div class="wrap-input100 validate-input" data-validate="Entrez le mot de passe">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password_inscription">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>
                    <div class="password_error input-error"></div>

					<div id="password_instructions" class="m-b-16">	
					<span>Pour votre sécurité, utilisez un mot de passe contenant:</span>
		                    <ul>
			                    <li>Au moins 8 caractères <i class="fas fa-check"></i></li> 
			                    <li>Au moins une lettre majuscule <i class="fas fa-check"></i></li>
			                    <li>Au moins un chiffre <i class="fas fa-check"></i></li>
			                </ul>
			        </div>
                    
                    <div class="validate-input" data-validate = "Choisissez une localisation">
					 <!--	<input class="input100" type="text" name="localisation_inscription">-->
                     <select class="form-control input100" name="localisation_inscription">
                         <option value="Default" selected="selected">choisir une localisation...</option>
                         <option value="Douala">Douala</option>
                         <option value="Pointe-Noire">Pointe-Noire</option>
                     </select>

                     <!-- <span class="focus-input100" data-placeholder="Localisation"></span> -->	
					</div>
                    <div class="localisation_error input-error"></div>
                    
    
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Valider
							</button>
						</div>
					</div>

		</form>
		</div>
	   </div>
	   <div><a href="privacyPolicy.php">Mentions Légales</a></div>

	</div>
</div>
	

	<div id="dropDownSelect1"></div>



<?php include('footer.php'); ?>