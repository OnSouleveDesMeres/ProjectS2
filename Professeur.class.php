<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/06/17
 * Time: 12:12
 */

require_once 'myPDO.class.php';

class Professeur{

    protected $IDPROF = null;

    protected $PRO_IDPROF = null;

    protected $NOM = null;

    protected $PRNM = null;

    protected $EMAIL = null;

    protected $NUMTEL = null;

    protected $VILLE = null;

    protected $CP = null;

    protected $RUE = null;

    protected $DATNS = null;


    public function getId()
    {
        return $this->IDPROF;
    }
    public function getIdSup(){
        return $this->PRO_IDPROF;
    }
    public function getNom()
    {
        return $this->NOM;
    }
    public function getPrenom(){
        return $this->PRNM;
    }
    public function getEmail(){
        return $this->EMAIL;
    }
    public function getNumeroTel(){
        return $this->NUMTEL;
    }
    public function getVille(){
        return $this->VILLE;
    }
    public function getCodePostal(){
        return $this->CP;
    }
    public function getRue(){
        return $this->RUE;
    }
    public function getDateNaissance(){
        return $this->DATNS;
    }

    public static function createFromId($id){

        $requete =<<<SQL
SELECT *
FROM PROFESSEUR
WHERE id = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Professeur');

        $res = $pdo->execute(array($id));

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }

    }

    public static function getAll(){

        $requete =<<<SQL
SELECT *
FROM PROFESSEUR
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Professeur');

        $res = $pdo->execute(array());

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }


    }

}