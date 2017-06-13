<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/06/17
 * Time: 16:43
 */


require_once 'webpage.class.php';
require_once 'myPDO.class.php';
require_once 'getFromBD.php';

$html = new WebPage("add to BD");

$db = myPDO::getInstance();

$html->appendCssUrl("cssInsert.css");


if(isset($_POST) && !empty($_POST)){

    insertIntoDB($db, "OBSERVABLE (IDCATG, LIBOBS)", "'{$_POST["idCatg"]}', '{$_POST["nom"]}'");

}

$select = "<select name='idCatg'>";

$catg = getCategories($db);

foreach ($catg AS $categorie){

    $select.="<option value='{$categorie->id}'>{$categorie->nom}</option>";

}

$select.="</select>";

$tab = "<table><tr><th>id observable</th><th>id catégorie</th><th>nom</th></tr>";


$html->appendContent("<form name='addToBD' method='post' action='insertObservable.php'>
<h1>Ajouter une nouvelle observable</h1>
<p>Catégorie : {$select}</p>
<p>Nom : <input name='nom' type='text'></p>
<button type='submit'>Enregistrer l'observable</button>
</form>");

echo $html->toHTML();