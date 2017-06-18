<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17/06/17
 * Time: 22:34
 */

function emailActivation($to, $user, $pass){

    mail($to, "Votre nouveau compte sur projectS2.tk", "Bonjour, votre compte sur http://projectS2.tk a bien été créé \nVoici vos identifiants gardez les précieusement : \nLogin : {$user}\nMot de passe : {$pass}", "Votre nouveau compte sur projectS2.tk", "-f account@ecole_du_pre_vers_l_aisne -F compte");

    header('Location: panel.php');
}