<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/05/17
 * Time: 20:35
 */
require_once 'myPDO.class.php';
function getCategories($db){

    $requete=<<<SQL
SELECT idCatg AS "id", cat_idCatg AS "idSup", libCatg AS "nom"
FROM CATEGORIE
SQL;

    $res = $db->query($requete);

    if ($res != null){

        $datas = $res->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

}

function getStudents($db){

    $requete=<<<SQL
SELECT idEleve AS "id", idClasse AS "idClass", nom AS "nom", prnm AS "prenom", email1 AS "email", numTel1 as "num", ville1 AS "ville", cp1 AS "cp", rue1 AS "rue", datns AS "datNs"
FROM ELEVE
SQL;

    $res = $db->query($requete);

    if ($res != null){

        $datas = $res->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

}

function getClasses($db){

    $requete=<<<SQL
SELECT idClasse AS "id", libClasse AS "nom"
FROM CLASSE
SQL;

    $res = $db->query($requete);

    if ($res != null){

        $datas = $res->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

}

function getProfessors($db){

    $requete=<<<SQL
SELECT idProf AS "id", pro_idProf AS "idSup", nom AS "nom", prnm AS "prenom", email AS "email", numTel as "num", ville AS "ville", cp AS "cp", rue AS "rue", datns AS "datNs"
FROM PROFESSEUR
SQL;

    $res = $db->query($requete);

    if ($res != null){

        $datas = $res->fetchAll(PDO::FETCH_OBJ);
        return $datas;

    }

}

function insertIntoDB($db, $table, $values){

    $requete=<<<SQL
INSERT INTO {$table} VALUES ({$values})
SQL;

    $stmt = $db->prepare($requete);
    $stmt->execute();

}
