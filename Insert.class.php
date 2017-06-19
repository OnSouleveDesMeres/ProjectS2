<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 22:47
 */

require_once 'myPDO.class.php';
require_once 'Professeur.class.php';

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
INSERT INTO PROFESSEUR (PRO_IDPROF, NOM, PRNM, EMAIL, NUMTEL, VILLE, CP, RUE, DATNS) VALUES ('{$IDSUP}', '{$NOM}', '{$PRNM}', '{$EMAIL}', '{$NUMTEL}', '{$VILLE}', '{$CP}', '{$RUE}', STR_TO_DATE('{$DATNS}','%Y-%m-%d'));
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

    public static function insertIntoUSer($id, $pass){

        $requete =<<<SQL
INSERT INTO USERS (IDUSER, PASSWORD) VALUES ('{$id}', '{$pass}');
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function insertIntoObservable($idCatg, $nom){

        $requete =<<<SQL
INSERT INTO OBSERVABLE (IDCATG, LIBOBS) VALUES ('{$idCatg}', '{$nom}');
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

    public static function insertIntoValidation($idObs, $idEleve, $value){

        $requete =<<<SQL
INSERT INTO VALIDATION (IDOBS, IDELEVE, valide) VALUES ('{$idObs}', '{$idEleve}', '{$value}');
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

    public static function insertIntoCategorie($idCatgSup, $nom){

        $requete =<<<SQL
INSERT INTO CATEGORIE (CAT_IDCATG, LIBCATG) VALUES ('{$idCatgSup}', '{$nom}');
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->execute(array());

    }

}