<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/06/17
 * Time: 11:13
 */

require_once 'Update.class.php';
require_once 'myPDO.class.php';

if(isset($_POST) && isset($_COOKIE['profId']) && !empty($_COOKIE['profId']) && isset($_COOKIE['observable']) && !empty($_COOKIE['observable'])){

    $pdo = myPDO::getInstance();
    $validate = $_POST['level'];

    $html = '';
    $a = array();
    $compteur = 0;
    foreach($_POST as $k => $v){
        $a[$compteur] = $_POST[$k];
        $compteur++;
    }

    $start = 0;
    $longueur = count($_POST) - 1;

    if (isset($_POST['checkAll']) && !empty($_POST['checkAll'])){
        $start = 1;
    }

    for ($i = $start; $i < $longueur; $i++){

        $requete =<<<SQL
UPDATE VALIDATION SET valide = '{$validate}' WHERE IDOBS = '{$_COOKIE["observable"]}' AND IDELEVE = '{$a[$i]}'
SQL;

        $pdo->query($requete);

    }

    header('Location: panel.php');

}
else{
    header('Location: observableForStudent.php');
}