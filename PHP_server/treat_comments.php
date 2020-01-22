<?php
session_start();
include '../functions.php';

$method = $_SERVER["REQUEST_METHOD"];

switch($method){
    case 'GET':
        if(isset($_GET["id_post"])) {
            $id_post = htmlspecialchars($_GET["id_post"]);
            echo displayComments($id_post);
        }
        break;

    case 'POST':
        if(isset($_SESSION["token"])){
         if($_SESSION["token"] == $_POST["token"]){

                $comment = array();
                $comment['message'] = htmlspecialchars($_POST["publication"]);
                $comment["id_user"] = htmlspecialchars($_POST["id_user"]);
                $comment["id_eventsposts"] = htmlspecialchars($_POST["id_eventsposts"]);

                 saveComment($comment);
             displayComments($comment["id_eventsposts"]);

        }else echo "vous êtes victime de la faille csrf";
    }else echo "connecte-toi";

        break;

    case 'PUT':
        echo "rien";
        break;

    case 'DELETE':
        echo "rien";
}

