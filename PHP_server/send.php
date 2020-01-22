<?php
 
$email=$_POST['email'];
$message=$_POST['message'];
echo $email;
echo $message;
// recuperation de l´id de l´utillisateur 
$bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$GetUserId = $bdd->prepare("SELECT id FROM Users WHERE Email = ?");
$GetUserId->bindValue(1, $email, PDO::PARAM_STR);
$GetUserId->execute();
$ans = $GetUserId->fetch();
echo $ans[0];

// Insertion du message 
$bdd1 = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$Insertmail = $bdd1->prepare("INSERT INTO mail (id_user, message) VALUES( :id_user,  :message) ");
		$Insertmail->bindValue(':id_user', $ans[0], PDO::PARAM_INT);
		$Insertmail->bindValue(':message', $message, PDO::PARAM_STR);
		$Insertmail->execute();


			
echo '<meta http-equiv="refresh" content="0;URL=../BAI.php">';
?>