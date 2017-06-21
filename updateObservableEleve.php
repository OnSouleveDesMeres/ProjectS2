<?php

require_once 'Observable.class.php';
require_once 'myPDO.class.php';

if (isset($_GET['id']) && ! empty($_GET['id'])) {
$observables = Observable::getAll();
$db = myPDO::getInstance();

$id = $_GET['id'];
$obs = array();

for ($i =0; $i < count($observables); $i++) {
	if (isset($_GET[$i]) && ! empty($_GET[$i])) {
		$valeur = $_GET[$i];
		$requete = <<<SQL
        UPDATE VALIDATION SET valide = '{$valeur}'
        WHERE IDELEVE={$id} AND IDOBS = {$i}
SQL;
        $db->query($requete);
	}
}
header("Location: eleve.php?id=".$id);
}
else {
	header("Location: index.php");
}