<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/06/17
 * Time: 12:12
 */

require_once 'myPDO.class.php';

class Eleve{

    protected $IDELEVE = null;

    protected $IDCLASSE = null;

    protected $NOM = null;

    protected $PRNM = null;

    protected $EMAIL1 = null;

    protected $NUMTEL1 = null;

    protected $VILLE1 = null;

    protected $CP1 = null;

    protected $RUE1 = null;

    protected $DATNS = null;

    protected $EMAIL2 = null;

    protected $NUMTEL2 = null;

    protected $VILLE2 = null;

    protected $CP2 = null;

    protected $RUE2 = null;

    public function getId(){
        return $this->IDELEVE;
    }
    public function getIdClass(){
        return $this->IDCLASSE;
    }
    public function getNom(){
        return $this->NOM;
    }
    public function getPrenom(){
        return $this->PRNM;
    }
    public function getEmail(){
        return $this->EMAIL1;
    }
    public function getNumeroTel(){
        return $this->NUMTEL1;
    }
    public function getVille(){
        return $this->VILLE1;
    }
    public function getCodePostal(){
        return $this->CP1;
    }
    public function getRue(){
        return $this->RUE1;
    }
    public function getDateNaissance(){
        return $this->DATNS;
    }
    public function getEmail2(){
        return $this->EMAIL2;
    }
    public function getNumeroTel2(){
        return $this->NUMTEL2;
    }
    public function getVille2(){
        return $this->VILLE2;
    }
    public function getCodePostal2(){
        return $this->CP2;
    }
    public function getRue2(){
        return $this->RUE2;
    }

    /**
     * @param id eleve
     * @return tableau d'instance d'élèves
     * @throws Exception
     */
    public static function createFromId($id){

        $requete =<<<SQL
SELECT *
FROM ELEVE
WHERE idEleve = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

        $res = $pdo->execute(array($id));

        if($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{
            throw new Exception('Erreur, impossible de récupérer l élève sélectionné');
        }

    }

    /**
     * Permet de récupérer la liste de tous les élèves triés par nom.
     *
     * @return tableau d'instances d'Eleve
     * @throws Exception
     */
    public static function getAll(){

        $requete =<<<SQL
SELECT *
FROM ELEVE
ORDER BY NOM
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

        $res = $pdo->execute(array());

        if($res){
            $datas = $pdo->fetchAll();
            return $datas;
        }
        else{
            throw new Exception('Erreur, impossible de récupérer les élèves');
        }

    }

    public function getObsValidatesStudent(){

        $requete =<<<SQL
SELECT *
FROM VALIDATION v, OBSERVABLE o
WHERE o.IDOBS = v.IDOBS
AND v.IDELEVE = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Observable');

        $res = $pdo->execute(array($this->getId()));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{
            throw new Exception('Erreur, impossible de récupérer les observables de cet élève');
        }

    }

    public function getObsNotValidatesStudent(){

        $requete =<<<SQL
SELECT *
FROM VALIDATION v, OBSERVABLE o
AND NOT EXISTS (SELECT *
FROM VALIDATION v, OBSERVABLE o
WHERE o.IDOBS = v.IDOBS
AND v.IDELEVE = ?)
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Observable');

        $res = $pdo->execute(array($this->getId()));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{
            throw new Exception('Erreur, impossible de récupérer les observables de cet élève');
        }

    }

}