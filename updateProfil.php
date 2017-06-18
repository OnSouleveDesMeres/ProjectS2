<?php
require_once "Professeur.class.php";
require_once "Users.class.php";
require_once 'myPDO.class.php';

if (isset($_COOKIE["profId"])) {
    $id = $_COOKIE["profId"];
    $db = myPDO::getInstance();
        
    if(isset($_GET["nom"]) && isset($_GET["prenom"]) && isset($_GET["datens"]) && isset($_GET["email"]) &&
        isset($_GET["telephone"]) && isset($_GET["rue"]) && isset($_GET["cp"]) && isset($_GET["ville"])) {
    
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom']; 
    $datns = $_GET['datens'];
    $email = $_GET['email']; 
    $telephone = $_GET['telephone']; 
    $rue = $_GET['rue']; 
    $cp = $_GET['cp']; 
    $ville = $_GET['ville'];
        $requete = <<<SQL
        UPDATE PROFESSEUR SET NOM = '{$nom}', PRNM = '{$prenom}', EMAIL = '{$email}', NUMTEL = '{$telephone}', VILLE = '{$ville}', CP = '{$cp}', RUE = '{$rue}', DATNS = '{$datns}'
        WHERE idprof={$id}
SQL;
        $db->query($requete);
        setcookie("profFirstName", $prenom, time()+20*60);
        setcookie("profId", $_COOKIE["profId"], time()+20*60);
    header("Location: index.php");
    }
    else {
        header("Location: index.php");
    }
    
}
else {
    header("Location: index.php");
}
    