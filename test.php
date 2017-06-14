<?php

require_once 'myPDO.class.php' ;
require_once 'Eleve.class.php' ;

$stmt = myPDO::getInstance()->prepare(<<<SQL
    SELECT *
    FROM ELEVE
SQL
) ;

$stmt->execute() ;

while (($ligne = $stmt->fetch()) !== false) {
    echo var_dump($ligne) . "\n" ;
}