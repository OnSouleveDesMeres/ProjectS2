<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/06/17
 * Time: 13:13
 */

require_once 'Eleve.class.php';
require_once 'Observable.class.php';
require_once 'Insert.class.php';

$eleves = Eleve::getAll();
$obs = Observable::getAll();

foreach ($eleves as $student){

    foreach ($obs as $observable){

        Insert::insertIntoValidation($observable->getId(), $student->getId(), 1);

    }

}

die('done');