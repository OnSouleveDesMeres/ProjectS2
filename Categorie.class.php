<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/06/17
 * Time: 09:04
 */

require_once 'myPDO.class.php';
require_once 'Observable.class.php';

class Categorie{

    protected $IDCATG = null;
    protected $CAT_IDCATG = null;
    protected $LIBCATG = null;

    public function getId(){
        return $this->IDCATG;
    }
    public function getIdSup(){
        return $this->CAT_IDCATG;
    }
    public function getNom(){
        return $this->LIBCATG;
    }

    public static function createFromId($id){

        $requete =<<<SQL
SELECT *
FROM CATEGORIE c
WHERE c.IDCATG = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $res = $pdo->execute(array($id));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, cette catégorie ne peut être trouvée');

        }

    }

    public static function getAll(){

        $requete =<<<SQL
SELECT *
FROM CATEGORIE
ORDER BY libcatg
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $res = $pdo->execute(array());

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, aucune catégorie ne peut être trouvée');

        }

    }

    public static function getAllExpectFirst(){

        $requete =<<<SQL
SELECT *
FROM CATEGORIE
WHERE CAT_IDCATG != 'NULL' 
ORDER BY libcatg
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $res = $pdo->execute(array());

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, aucune catégorie ne peut être trouvée');

        }

    }

    public static function getFirst(){

        $requete =<<<SQL
SELECT *
FROM CATEGORIE 
WHERE IDCATG = 1
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $res = $pdo->execute(array());

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }

    }

    public function getObs(){

        $requete =<<<SQL
SELECT *
FROM OBSERVABLE o
WHERE o.IDCATG = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Observable');

        $res = $pdo->execute(array($this->getId()));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, cette observable ne peut être trouvée');

        }

    }

    public function getCatg(){

        $requete =<<<SQL
SELECT *
FROM CATEGORIE c
WHERE CAT_IDCATG = ?
ORDER BY CAT_IDCATG
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $res = $pdo->execute(array($this->getId()));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, cette catégorie ne peut être trouvée');

        }

    }

}