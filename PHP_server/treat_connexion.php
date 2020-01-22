<?php

$input = array();
$input = $_POST;

//$input = json_decode(file_get_contents('php://input'), true);
if(isset($input["confirmation"])){

    if($input["confirmation"] == "£node_SERV"){

        session_start();

        $_SESSION["id"] = $input["id"];
        $_SESSION["name"] = $input["name"];
        $_SESSION["surname"] = $input["surname"]; 
        $_SESSION["email"] = $input["email"];
        $_SESSION["localisation"] = $input["localisation"];
        $_SESSION["status"] = $input["status"];
        $_SESSION["time"] = time();
        $_SESSION["token"] = sha1(time()*rand(0,9999));

   //     setcookie('name', 'paul', time() + 365*24*3600, null, null, false, true);
     //   print_r($_COOKIE);
        echo "done";

    }
}


?>