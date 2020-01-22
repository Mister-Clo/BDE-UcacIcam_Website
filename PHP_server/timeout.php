<?php

session_start();
if(isset($_SESSION["time"])){
    $diff = time()-$_SESSION['time'];
    if($diff > 20*60){
       session_destroy();
       echo "session expirée";
    }else{
        $_SESSION["time"] = time();
        echo $diff;
    }
}else
echo "pas de session";
