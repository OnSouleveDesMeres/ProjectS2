<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/06/17
 * Time: 08:27
 */

require_once 'Update.class.php';
require_once 'Users.class.php';

function changePassword($id, $lastpass, $newpass)
{
    if (isset($_COOKIE["profId"]) && !empty($_COOKIE{"profId"})) {

        $user = Users::createFromId($_COOKIE["profId"]);

        if ($user[0]->getPassword() == sha1($lastpass)) {
            Update::updateUser($_COOKIE["profId"], 'PASSWORD', sha1($newpass));
            return '<div class="alert alert-success offset-md-2 col-md-8 offset-md-2 text-center" role="alert">Le mot de passe a été changé avec succès</div>';
        } else {
            return '<div class="alert alert-danger offset-md-2 col-md-8 offset-md-2 text-center" role="alert">Identifiant ou mot de passe incorrect</div>';
        }

    } else {

        return '<div class="alert alert-danger offset-md-2 col-md-8 offset-md-2 text-center" role="alert">Impossible de changer le mot de passe pour le moment, réessayez plus tard</div>';

    }
}