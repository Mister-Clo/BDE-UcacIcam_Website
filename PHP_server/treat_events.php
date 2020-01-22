<?php
session_start();
include '../functions.php';

$method = $_SERVER["REQUEST_METHOD"];
$saved_url="d";

switch($method) {
    case 'GET':
        break;

    case 'POST':
        if(!isset($_GET["todo"])) {
            $input = json_decode(file_get_contents("php://input", true));

            $input->idUser = htmlspecialchars($input->idUser);
            $input->idEvent = htmlspecialchars($input->idEvent);
            $input->tokenUser = htmlspecialchars($input->tokenUser);

            if ($_SESSION["token"] == $input->tokenUser) {
                $res = registerUser($input);
                if ($res == 1) echo "inscription réussie";
                else echo "vous êtes déjà inscrit";
            }
        }else{
            if(isset($_SESSION["token"])){
                if($_SESSION["token"] == $_POST["token"]){
                    $saved = saveImage();

                    if($saved){
                        $event = array();
                        $event['description'] = $_POST["description"];
                        $event["urlimage"] = $saved_url;
                        $event["date"] =$_POST["date"] ;
                        $event["nom"] =$_POST["nom"] ;
                        $event["id_user"] =$_POST["id_User"];

                        echo saveEvent($event);
                    }else echo "image pas sauvegardée";
                }else echo "vous êtes victime de la faille csrf";
            }else echo "connecte-toi";
        }
        break;

    case 'DELETE':
        echo "rien";

}


function saveImage(){
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $tab = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($tab));
        $extensions = array("jpeg", "jpg", "png", "webp");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension d'images non prise en compte";
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be less than 2 MB';
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "../assets/images/evenements/" . $file_name);
            global $saved_url;
            $saved_url= "assets/images/evenements/" . $file_name;
            return true;
        } else{
            return false;
        }
    }

}