<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/06/17
 * Time: 14:45
 */
require_once "Professeur.class.php";
require_once "Users.class.php";
require_once 'myPDO.class.php';

if (isset($_COOKIE["profId"])) {
    $id = $_GET['idEleve'];
    $db = myPDO::getInstance();

    var_dump('hello');
    if(isset($_GET["nom"]) && isset($_GET["prenom"]) && isset($_GET["datens"]) &&
        isset($_GET["telephone"]) && isset($_GET["rue"]) && isset($_GET["cp"]) && isset($_GET["ville"]) && isset($_GET["classe"])
        && !empty($_GET["nom"]) && !empty($_GET["prenom"]) && !empty($_GET["datens"]) &&
        !empty($_GET["telephone"]) && !empty($_GET["rue"]) && !empty($_GET["cp"]) && !empty($_GET["ville"]) && !empty($_GET["classe"])) {

        var_dump('world');

        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $datns = $_GET['datens'];
        $email = $_GET['email'];
        $telephone = $_GET['telephone'];
        $rue = $_GET['rue'];
        $cp = $_GET['cp'];
        $ville = $_GET['ville'];
        $classe = $_GET['classe'];
        $ville2 = $_GET['ville2'];
        $email2 = $_GET['email2'];
        $cp2 = $_GET['cp2'];
        $rue2 = $_GET['rue2'];
        $numtel2 = $_GET['telephone2'];

        $requete = <<<SQL
        UPDATE ELEVE SET IDCLASSE ='{$classe}', NOM = '{$nom}', PRNM = '{$prenom}', EMAIL1 = '{$email}', NUMTEL1 = '{$telephone}', VILLE1 = '{$ville}', CP1 = '{$cp}', RUE1 = '{$rue}', DATNS = '{$datns}', EMAIL2 = '{$email2}', NUMTEL2 = '{$telephone2}', VILLE2 = '{$ville2}', CP2 = '{$cp2}', RUE2 = '{$rue2}'
        WHERE IDELEVE={$id}
SQL;
        $db->query($requete);

        header('location: panel.php');
    }

}
else {
    header("Location: index.php");
}