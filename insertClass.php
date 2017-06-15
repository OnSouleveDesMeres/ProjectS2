<?php<?php
require_once 'myPDO.class.php';
require_once 'webpage.class.php';
require_once 'Eleve.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Classe.class.php';
/**
 * Created by PhpStorm.
 * User: root
 * Date: 01/06/17
 * Time: 14:27
 */

require_once 'webpage.class.php';
require_once 'myPDO.class.php';
require_once 'getFromBD.php';

$html = new WebPage("add to BD");

$db = myPDO::getInstance();

$html->appendContent("<form name='addToBD' method='post' action='insertClass.php'>
<h1>Ajouter une nouvelle classe</h1>
<p>Nom : <input name='nom' type='text'></p>
<button type='submit'>Enregistrer la classe</button>
</form>");

if(isset($_POST) && !empty($_POST)){

    insertIntoDB($db, "CLASSE (LIBCLASSE)", "'{$_POST["nom"]}'");

}

$classes = "<table><tr><th>id classe</th><th>nom de la classe</th></tr>";

$listeClasses = getClasses($db);

foreach ($listeClasses as $class){

    $classes .= "<tr><th>{$class->id}</th><th>{$class->nom}</th></tr>";

}

$html->appendContent($classes."</table>");

echo $html->toHTML();