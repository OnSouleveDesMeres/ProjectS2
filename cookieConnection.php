<?php
require_once "Professeur.class.php";

  if (!isset($_cookie["prof"])) {
   if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['password']) && !empty($_POST['password']) ) {
    $id = $_POST['id'];

   $professeur = professeur::createFromID($id);

   if ( $professeur != null ) {

        if (!isset($_COOKIE["prof"])) {
            setcookie("prof",$professeur,time()+20);
            header("Location: http://localhost/PHP/ProjectS2/index.php");
        }
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
