<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 22:47
 */

require_once 'myPDO.class.php';

class Insert{

    public static function insertIntoStudent($IDCLASSE, $NOM, $PRNM, $EMAIL1, $NUMTEL1, $VILLE1, $CP1, $RUE1, $DATNS, $EMAIL2 = null, $NUMTEL2 = null, $VILLE2 = null, $CP2 = null, $RUE2 = null){

        $requete =<<<SQL
INSERT INTO ELEVE (IDCLASSE, NOM, PRNM, EMAIL1, NUMTEL1, VILLE1, CP1, RUE1, DATNS, EMAIL2, NUMTEL2, VILLE2, CP2, RUE2) VALUES ('{$IDCLASSE}', '{$NOM}', '{$PRNM}', '{$EMAIL1}', '{$NUMTEL1}', '{$VILLE1}', '{$CP1}', '{$RUE1}', STR_TO_DATE('{$DATNS}','%m/%d/%Y'), '{$EMAIL2}', '{$NUMTEL2}', '{$VILLE2}', '{$CP2}', '{$RUE2}');
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

    public static function insertIntoProfessor($IDSUP, $NOM, $PRNM, $EMAIL, $NUMTEL, $VILLE, $CP, $RUE, $DATNS){

        $requete =<<<SQL
INSERT INTO ELEVE (PRO_IDPROF, NOM, PRNM, EMAIL, NUMTEL, VILLE, CP, RUE, DATNS) VALUES ('{$IDSUP}', '{$NOM}', '{$PRNM}', '{$EMAIL}', '{$NUMTEL}', '{$VILLE}', '{$CP}', '{$RUE}', STR_TO_DATE('{$DATNS}','%m/%d/%Y'));
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

}