<?php
  require_once = "Professeur.class.php";

function verifLog() {
  if (!isset($_cookie["prof"])) {
   if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['password']) && !empty($_POST['password']) ) {
    $id = $_POST['id'];
   $password = $_POST['password'];

   $professeur = professeur::createFromID($id);

   if ( $professeur != null ) {

    if (!isset($_COOKIE["prof"])) {
            setcookie["prof",$professeur,time()+20];
        }
      }
      else {
      header('Location: ');
      exit();
    }
      }
    }
}
