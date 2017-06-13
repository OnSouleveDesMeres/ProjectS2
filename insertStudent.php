<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30/05/17
 * Time: 08:46
 */

require_once 'webpage.class.php';
require_once 'myPDO.class.php';
require_once 'getFromBD.php';

$html = new WebPage("add to BD");

$db = myPDO::getInstance();

$html->appendCssUrl("//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
$html->appendCssUrl("/resources/demos/style.css");
$html->appendCssUrl("cssInsert.css");
$html->appendJsUrl("https://code.jquery.com/jquery-1.12.4.js");
$html->appendJsUrl("https://code.jquery.com/ui/1.12.1/jquery-ui.js");
$html->appendJs("  $( function() {
    $( '#datepicker' ).datepicker();
  } );");


if(isset($_POST) && !empty($_POST)){

    if (isset($_POST["divorce"])) {
        insertIntoDB($db, "ELEVE (IDCLASSE, NOM, PRNM, EMAIL1, NUMTEL1, VILLE1, CP1, RUE1, EMAIL2, NUMTEL2, VILLE2, CP2, RUE2, DATNS)", "'{$_POST["classe"]}', '{$_POST["nom"]}', '{$_POST["prenom"]}', '{$_POST["email1"]}', '{$_POST["numTel1"]}', '{$_POST["ville1"]}', '{$_POST["cp1"]}', '{$_POST["rue1"]}', '{$_POST["email2"]}', '{$_POST["numTel2"]}', '{$_POST["ville2"]}', '{$_POST["cp2"]}', '{$_POST["rue2"]}', STR_TO_DATE('{$_POST["datns"]}','%m/%d/%Y')");
    }
    else{
        insertIntoDB($db, "ELEVE (IDCLASSE, NOM, PRNM, EMAIL1, NUMTEL1, VILLE1, CP1, RUE1, DATNS)", "'{$_POST["classe"]}', '{$_POST["nom"]}', '{$_POST["prenom"]}', '{$_POST["email1"]}', '{$_POST["numTel1"]}', '{$_POST["ville1"]}', '{$_POST["cp1"]}', '{$_POST["rue1"]}', STR_TO_DATE('{$_POST["datns"]}','%m/%d/%Y')");
    }
}

$select = "<select name='classe'>";

$classes = getClasses($db);

foreach ($classes AS $classe){

    $select.="<option value='{$classe->id}'>{$classe->nom}</option>";

}

$select.="</select>";

$students = getStudents($db);
$tab = "<table><tr><th>id élève</th><th>id classe</th><th>nom</th><th>prenom</th><th>email</th><th>numTel</th><th>ville</th><th>code postal</th><th>rue</th><th>date de naissance</th></tr>";

foreach ($students AS $eleves){
    $tab.="<tr><td>{$eleves->id}</td><td>{$eleves->idClasse}</td><td>{$eleves->nom}</td><td>{$eleves->prenom}</td><td>{$eleves->email}</td><td>{$eleves->numTel}</td><td>{$eleves->ville}</td><td>{$eleves->cp}</td><td>{$eleves->rue}</td><td>{$eleves->datNs}</td></tr>";
}

$html->appendContent("<form name='addToBD' method='post' action='insertStudent.php'>
<h1>Ajouter un nouvel élève</h1>
<input name='divorce' type='checkbox'><label for='divorce'>Adresse des parents différentes ?</label>
<p>Classe : {$select}</p>
<p>Nom : <input name='nom' type='text'></p>
<p>Prenom : <input name='prenom' type='text'></p>
<div>
<p>email1 : <input name='email1' type='text'></p>
<p>numTel1 : <input name='numTel1' type='text'></p>
<p>ville1 : <input name='ville1' type='text'></p>
<p>cp1 : <input name='cp1' type='text'></p>
<p>rue1 : <input name='rue1' type='text'></p>
<p>email2 : <input name='email2' type='text'></p>
<p>numTel2 : <input name='numTel2' type='text'></p>
<p>ville2 : <input name='ville2' type='text'></p>
<p>cp2 : <input name='cp2' type='text'></p>
<p>rue2 : <input name='rue2' type='text'></p>
</div>
<p>datNs : <input name='datns' type='text' id='datepicker'></p>
<button type='submit'>Enregistrer l'élève</button>
</form>");

$html->appendContent($tab);

echo $html->toHTML();