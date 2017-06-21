<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/05/17
 * Time: 10:33
 */

require_once 'webpage.class.php';
require_once 'getFromBD.php';


$html = new WebPage("add to BD");
$pdo = myPDO::getInstance();

$html->appendCssUrl("cssInsert.css");

$categories = "";

if(isset($_POST) && !empty($_POST)){

    insertIntoDB($pdo, "CATEGORIE (LIBCATG, CAT_IDCATG)", "'{$_POST["nom"]}', '{$_POST["id"]}'");

}

$datas = getCategories($pdo);
$tableau = "<table><tr><th>Nom observable</th><th>id observable</th><th>id prédécesseur</th></tr>";
$compteur = 0;

foreach($datas as $donnees){

    $compteur++;
    $categories .= "<option value='{$donnees->id}'>{$donnees->nom}</option>";

    if ($compteur%2 == 0){
        $tableau .= "<tr><td>{$donnees->nom}</td><td>{$donnees->id}</td><td>{$donnees->idSup}</td></tr>";
    }
    else{
        $tableau .= "<tr class='impair'><td>{$donnees->nom}</td><td>{$donnees->id}</td><td>{$donnees->idSup}</td></tr>";
    }

}

$tableau .= "</table>";

$html->appendContent("<form name='addToBD' method='post' action='insertCategory.php'>
<h1>Ajouter une nouvelle catégorie</h1>
<p>Nom : <input name='nom' type='text'></p>
<p>La catégorie est contenue dans : <select name='id'>{$categories}</select></p><button type='submit'>Enregistrer la catégorie</button>
</form>");

$html->appendContent($tableau);

echo $html->toHTML();