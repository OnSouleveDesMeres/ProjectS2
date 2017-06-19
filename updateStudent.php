<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/06/17
 * Time: 14:45
 */
require_once "Professeur.class.php";
require_once "Users.class.php";
require_once "Update.class.php";
require_once 'myPDO.class.php';

if (isset($_COOKIE["profId"])) {
    $id = $_POST['idEleve'];
    $db = myPDO::getInstance();

    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["datens"]) &&
        isset($_POST["telephone"]) && isset($_POST["rue"]) && isset($_POST["cp"]) && isset($_POST["ville"]) && isset($_POST["classe"])
        && !empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["datens"]) &&
        !empty($_POST["telephone"]) && !empty($_POST["rue"]) && !empty($_POST["cp"]) && !empty($_POST["ville"]) && !empty($_POST["classe"])) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $datns = $_POST['datens'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $rue = $_POST['rue'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $classe = $_POST['classe'];
        $ville2 = $_POST['ville2'];
        $email2 = $_POST['email2'];
        $cp2 = $_POST['cp2'];
        $rue2 = $_POST['rue2'];
        $numtel2 = $_POST['telephone2'];
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
                Update::updateStudent($id, 'IMGPATH', "{$dossier}{$fichier}");
            }
        }

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