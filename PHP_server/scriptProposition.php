<?php 
session_start();

if(isset($_SESSION['token'])) {

    if ($_POST["token"] == $_SESSION['token']) {

        $activity = $_POST['Activity'];
        $id_user = $_SESSION['id'];


        //Récupération IDUser
        $bdd = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $bdd1 = new PDO('mysql:host=localhost; dbname=bde_website;charset=UTF8', 'root', '');

        //Insertion de l'idée
        $InsertIdea = $bdd1->prepare("INSERT INTO Ideas (Activity,  IDUser) VALUES( :Activity,  :IDUser) ");
        $InsertIdea->bindValue(':Activity', $activity, PDO::PARAM_STR);
        $InsertIdea->bindValue(':IDUser', $id_user, PDO::PARAM_INT);
        $InsertIdea->execute();

        //Récupération de l'ID de la proposition
        $GetProposalId = $bdd1->prepare("SELECT id FROM Ideas WHERE Activity = ?");
        $GetProposalId->execute(array($activity));
        $ans2=$GetProposalId->fetch();

        //Insertion du vote de l´utilisateur
        $InsertVote= $bdd1->prepare("INSERT INTO votes (Id_Users,Id_Ideas) VALUES( ?, ?)");
        $InsertVote->execute(array($id_user,$ans2[0]));
        echo '<meta http-equiv="refresh" content="0;URL=../BAI.php">';
    }
}

?>