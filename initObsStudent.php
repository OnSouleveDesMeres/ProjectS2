<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/06/17
 * Time: 13:39
 */
require_once 'myPDO.class.php';
require_once 'Eleve.class.php';
require_once 'Observable.class.php';

function initObs($id){
    $obs = Observable::getAll();

    foreach ($obs as $o) {
        Insert::insertIntoValidation($o->getId(), $id, 1);
    }

}

function initStud($id){

    $students = Eleve::getAll();

    foreach ($students as $student){
        Insert::insertIntoValidation($id, $student->getId(), 1);
    }

}