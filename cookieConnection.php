<?php
require_once "Professeur.class.php";
require_once "Users.class.php";
require_once 'hash.php';

if (!isset($_cookie["prof"])) {
    if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['password']) && !empty($_POST['password']) ) {
        $id = $_POST['id'];
        $pass = $_POST['password'];

        $user = Users::createFromId($id);

        $professeur = professeur::createFromID($id);

        if ( $professeur != null && $user[0]->getPassword() == hashSet($pass)) {
            setcookie("profId", $professeur[0]->getId(), time()+(60*60));
            setcookie("profFirstName", $professeur[0]->getPrenom(), time()+(20*60));
            header("Location: index.php");
        }
        else {
            header("Location: login.php");
        }
    }
    else{
        header("Location: login.php");
    }
}
else{
  header("Location: index.php");
}
