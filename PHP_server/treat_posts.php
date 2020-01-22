<?php
session_start();
include '../functions.php';

$method = $_SERVER["REQUEST_METHOD"];
$saved_url="d";

switch($method) {
    case 'GET':
        break;

    case 'POST':
        if(isset($_SESSION["token"])){
            if($_SESSION["token"] == $_POST["token"]){
                $saved = saveImage();

                if($saved){
                    $post = array();
                    $post['description'] = $_POST["description"];
                    $post["urlimage"] = $saved_url;
                    $post["id_user"] =$_POST["id_User"] ;
                    $post["id_event"] =$_POST["id_Event"];

                   echo savePost($post);
                }else echo "image pas sauvegardée";
            }else echo "vous êtes victime de la faille csrf";
        }else echo "connecte-toi";

        break;

    case 'PUT':
        echo "rien";
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
            move_uploaded_file($file_tmp, "../assets/images/posts/" . $file_name);
            global $saved_url;
            $saved_url= "assets/images/posts/" . $file_name;
            return true;
        } else{
            return false;
        }
    }

}