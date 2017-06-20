<?php

require_once 'Observable.class.php';
require_once 'myPDO.class.php';
$observables = Observable::getAll();

$obs = array();

for ($i =0; $i < count($observables); $i++) {
	if (isset($_GET[$i]) && ! empty($_GET[$i])) {
		$obs[$i] = $_GET[$i];
	}
}
var_dump($obs);
/*
forach ($obs as $o) {

}*/