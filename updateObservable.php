<?php
require_once "Observable.class.php";
require_once "Categorie.class.php";
require_once 'myPDO.class.php';

if (isset($_COOKIE["profId"])) {
    $id = $_COOKIE["profId"];
    $db = myPDO::getInstance();
        
    if(isset($_GET["nom"]) && isset($_GET["categorie"]) && isset($_GET["idObs"])) {

    $nom = $_GET['nom'];
    $categorie = $_GET['categorie'];
    $idObs = $_GET['idObs'];
        $requete = <<<SQL
        UPDATE OBSERVABLE SET LIBOBS = '{$nom}', IDCATG = '{$categorie}'
        WHERE IDOBS={$idObs}
SQL;
        $db->query($requete);
    header("Location: panel.php");      
    }
    else {
    header("Location: index.php");
    }
    
}
    