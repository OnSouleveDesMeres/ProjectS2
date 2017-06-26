<?php
require_once "Professeur.class.php";
require_once "Users.class.php";
require_once 'Update.class.php';
require_once 'myPDO.class.php';

if (isset($_COOKIE["profId"])) {
    $id = $_COOKIE["profId"];
    $db = myPDO::getInstance();
    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["datens"]) && isset($_POST["email"]) &&
        isset($_POST["telephone"]) && isset($_POST["rue"]) && isset($_POST["cp"]) && isset($_POST["ville"])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $datns = $_POST['datens'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $rue = $_POST['rue'];
    $cp = $_POST['cp'];
    $ville = $_POST['ville'];
    if(isset($_FILES['avatar']) && !empty($_FILES['avatar'])){
        $dossier = 'img/users/';
        $taille_maxi = 9999999999999;
        $taille = filesize($_FILES['avatar']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['avatar']['name'], '.');
//Début des vérifications de sécurité...
        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
        }
        if($taille>$taille_maxi)
        {
            $erreur = 'Le fichier est trop gros...';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = $nom.$prenom;
            $fichier = strtr($fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier);
            Update::updateProf($_COOKIE['profId'], 'IMGPATH', "{$dossier}{$fichier}");
        }
    }
        $requete = <<<SQL
        UPDATE PROFESSEUR SET NOM = '{$nom}', PRNM = '{$prenom}', EMAIL = '{$email}', NUMTEL = '{$telephone}', VILLE = '{$ville}', CP = '{$cp}', RUE = '{$rue}', DATNS = '{$datns}'
        WHERE idprof={$id}
SQL;
        $db->query($requete);
        setcookie("profFirstName", $prenom, 0);
        setcookie("profId", $_COOKIE["profId"], 0);
    }
    
}
header('Location: panel.php');
