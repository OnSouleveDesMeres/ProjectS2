<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/06/17
 * Time: 20:57
 */

require_once 'myPDO.class.php';

class Observable{

    protected $IDOBS = null;

    protected $IDCATG = null;

    protected $LIBOBS = null;

    public function getId(){
        return $this->IDOBS;
    }
    public function getIdCatg(){
        return $this->IDCATG;
    }
    public function getNom(){
        return $this->LIBOBS;
    }

    public static function createFromId($id){

        $requete =<<<SQL
SELECT *
FROM OBSERVABLE o
WHERE o.IDOBS = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Observable');

        $res = $pdo->execute(array($id));

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, impossible de trouver cette observable');

        }

    }

    public static function getAll(){

        $requete =<<<SQL
SELECT *
FROM OBSERVABLE
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Observable');

        $res = $pdo->execute(array());

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, impossible de trouver cette observable');

        }

    }

    public function getStudentsHaveObs(){

        $requete =<<<SQL
SELECT *
FROM ELEVE e, VALIDATION v
WHERE v.IDOBS = ?
AND e.IDELEVE = v.IDELEVE
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

        $res = $pdo->execute(array($this->getId()));

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, aucun élève ne possède cette observable');

        }

    }

    public function getStudentsNotHaveObs(){

        $requete =<<<SQL
SELECT *
FROM ELEVE e, VALIDATION v
AND NOT EXISTS (SELECT *
FROM ELEVE e, VALIDATION v
WHERE v.IDOBS = ?
AND e.IDELEVE = v.IDELEVE)
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

        $res = $pdo->execute(array($this->getId()));

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, aucun élève ne possède cette observable');

        }

    }

}