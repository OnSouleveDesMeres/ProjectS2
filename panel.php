<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/06/17
 * Time: 21:02
 */

require_once 'webpage.class.php';

if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"])){

    echo "ça marche";

}
else{

    header('Location: login.php');

}