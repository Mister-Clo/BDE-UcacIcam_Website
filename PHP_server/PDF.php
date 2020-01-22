<?php
include  'fpdf/fpdf.php';

class PDF extends FPDF
{

// En-tête
    function Header()
    {
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(50,10,"Liste des inscrits",1,0,'C');
        // Saut de ligne
        $this->Ln(20);
    }

    //Remplissage
    function fill($liste)
    {
        foreach($liste as $list){
            $this->Cell(15,7,strtoupper($list["name"]));
            $this->Cell(15,7,$list["surname"]);
            $this->Cell(15,7,$list["email"]);
            $this->Ln();
        }
    }

// Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}