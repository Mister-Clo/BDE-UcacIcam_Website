<?php
session_start();
include  '../functions.php';
include  'PDF.php';

$tab = explode('/',$_SERVER['PHP_SELF']);
$route = end($tab);
$idevent = 0;

if(isset($_GET["idevent"])){
    $idevent = $_GET["idevent"];
}
$liste = listeDesInscrits($idevent);

if($route == "liste_des_inscrits_pdf"){



$pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->fill($liste);
    $pdf->Output();
}
else if($route == "liste_des_inscrits_csv"){

    $file = "../Listes/".$idevent."_inscriptions.csv";

    shell_exec("rm ".$file);
    shell_exec("type nul > ".$file);
    $fp = fopen($file, 'w');

    foreach($liste as $list){
        $input['name'] = strtoupper($list['name']);
        $input['surname'] = $list['surname'];
        $input['email'] = $list['email'];

        fputcsv($fp,$input);
    }
    $file = "./Listes/".$idevent."_inscriptions.csv";
    echo $file;

}

else if($route == "likes"){

    $input = json_decode(file_get_contents("php://input", true));

    $input->idUser = htmlspecialchars($input->idUser);
    $input->idPost = htmlspecialchars($input->idPost);
    $input->tokenUser = htmlspecialchars($input->tokenUser);

    if ($_SESSION["token"] == $input->tokenUser) {
        $res = registerLike($input);

        if($res == 1){
            $BDD = new PDO('mysql:host=localhost;dbname=bde_website;charset=utf8','root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $likes = $BDD->prepare("SELECT COUNT(*) as nb FROM eventsposts inner join likes on eventsposts.Id = likes.Id_posts  where Likes.Id_posts=? GROUP BY Id_posts");
            $likes->execute(array($input->idPost));
            $likes = $likes->fetch();

            echo $likes["nb"];
        }else{
            echo "non";
        }

    }

}
else if($route == "toutes_les_images"){

    $a = shell_exec(' dir  ');
    shell_exec('type nul > ../assets/images/posts.zip');
   echo $a;
    echo "./assets/images/posts.zip";

}