<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/05/17
 * Time: 22:35
 */

require_once 'webpage.class.php';
require_once 'myPDO.class.php';
require_once 'getFromBD.php';

$html = new WebPage("add to BD");

$db = myPDO::getInstance();

if(isset($_POST) && !empty($_POST)){

    var_dump($_POST);

    if(isset($_POST['email']) && !empty($_POST['email'])){
        header("Location: createAccount.php?mailTo={$_POST['email']}");
    }

    $superior = null;

    if ($_POST["sup"] != null){
        $superior = $_POST["sup"];
    }

    insertIntoDB($db, "PROFESSEUR (PRO_IDPROF, NOM, PRNM, EMAIL, NUMTEL, VILLE, CP, RUE, DATNS)", "'{$superior}', '{$_POST["nom"]}', '{$_POST["prenom"]}', '{$_POST["email"]}', '{$_POST["numTel"]}', '{$_POST["ville"]}', '{$_POST["cp"]}', '{$_POST["rue"]}', STR_TO_DATE('{$_POST["datns"]}','%m/%d/%Y')");

}

$professeurs = getProfessors($db);

$select = "<select name='sup'>";

foreach ($professeurs as $p){
    $select .= "<option value='$p->id'>$p->nom</option>";
}

$select.="</select>";

$html->appendCssUrl("//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
$html->appendCssUrl("cssInsert.css");
$html->appendCssUrl("/resources/demos/style.css");
$html->appendJsUrl("https://code.jquery.com/jquery-1.12.4.js");
$html->appendJsUrl("https://code.jquery.com/ui/1.12.1/jquery-ui.js");
$html->appendJs("  $( function() {
    $( '#datepicker' ).datepicker();
  } );");

$html->appendContent("<form name='addToBD' method='post' action='insertProfessor.php'>
<h1>Ajouter un nouveau professeur</h1>
<p>Professeur supérieur : {$select}</p>
<p>Nom : <input name='nom' type='text'></p>
<p>Prenom : <input name='prenom' type='text'></p>
<p>email : <input name='email' type='text'></p>
<p>numTel : <input name='nom' type='text'></p>
<p>ville : <input name='nom' type='text'></p>
<p>cp : <input name='nom' type='text'></p>
<p>rue : <input name='nom' type='text'></p>
<p>datNs : <input type='text' id='datepicker'></p>
<button type='submit'>Enregistrer le professeur</button>
</form>");

echo $html->toHTML();
