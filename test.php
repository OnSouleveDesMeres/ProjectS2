<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/06/17
 * Time: 12:32
 */

require_once 'Classe.class.php';

$p = Classe::createFromId(1);
var_dump($p);

var_dump($p[0]->getId());

$e = $p[0]->getStudentFromClassId();

var_dump($e);