<?php session_start();
include 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Vendors -->

    <link rel="stylesheet" href="./assets/vendors/fontawesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/vendors/iconic/css/material-design-iconic-font.min.css">
    
    <link rel="stylesheet" href="./assets/vendors/bootstrap/css/bootstrap.min.css">
    
    <!-- Fichiers css -->
    <link rel="stylesheet" href="./css/main1.css">
    <link rel="stylesheet" href="./css/login1.css">
    <link rel="stylesheet" href="./css/util.css">
    <link rel="stylesheet" href="./css/bde.css">
    <link rel="stylesheet" href="./css/panier.css">



    <!-- icone --> 
    <link rel="shortcut icon" type="image/ico" href="./assets/images/autres/bde1.jpg"/>
  
    <!-- title -->
    <title>BDE Ucac-Icam Douala</title>
    <meta name="description" content="Multi level hover dropdown Navbar for bootstrap 4">
    <meta name="keywords" content="Multi level hover dropdown Navbar for bootstrap 4">
</head>

<body>


<div class="contain">
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark " id="main_navbar">
        <a class="navbar-brand" href="#"><img class="logo rounded-circle img-thumbnail" src="./assets/images/autres/bde1.jpg" alt="Logo du BDE" title="logo du BDE" width="100" height="100" class="d-inline-block align-top"></a><h2>BDE Ucac-Icam</h2>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="index.php"><i class="fas fa-home"></i>Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    data-hover="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-graduate"></i>
                        BDE
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="BDEpresentation.php">Présentation du BDE</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="BDEmembers.php">Membres du BDE</a></li>
                    </ul>
                  </li> 

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-calendar-alt"></i>
                        Evènements
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="PastEvents.php">Evènements passés</a></li>
                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="FutureEvents.php">A venir...</a></li>
                        <?php if(isset($_SESSION["status"])){ ?>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="BAI.php">Boîte à idées</a></li>
                        <?php } ?>
                    </ul>
                  </li>  
                 <li class="nav-item dropdown">
                    <a class="nav-link" href="store.php"><i class="fas fa-store"></i>Boutique</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <?php  echo isset($_SESSION["status"]) ? "<i class='fas fa-user-circle'></i>". ucfirst($_SESSION["name"])." ".ucfirst($_SESSION["surname"]) : "<i style='color: white;font-size: 1.2em' class='fas fa-user'></i> S'identifier";?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                       <?php
                       userPresentation();
                      ?>
                    </ul>
                  </li>
                <?php if(isset($_SESSION["status"])){
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="mailbox.php"><i class="fas fa-mail-bulk"></i>MailBox</a>
                    </li>

                    <?php
                if($_SESSION["status"]==1){
                ?>
                <li class="nav-item dropdown">
                    <a id="mbde" class="nav-link" href="administration.php"><i class="fas fa-user-cog"></i>Admin Store</a>
                </li>
                <?php
                    }
                  }
                  ?>




            </ul>
        </div>
    </nav>
  </header>

  <!-- Modal connexion -->
  <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <?php include("connexion.php") ?>
      </div>
    </div>
  </div>
</div>

