<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/06/17
 * Time: 15:18
 */

require_once 'myPDO.class.php';

class Validation{

    protected $IDOBS = null;
    protected $IDELEVE = null;
    protected $valide = null;


    public function getIDELEVE()
    {
        return $this->IDELEVE;
    }
    public function getIDOBS()
    {
        return $this->IDOBS;
    }
    public function getValide()
    {
        return $this->valide;
    }

    public static function createFrom2Param($idEleve, $idObs){

        $requete =<<<SQL
SELECT *
FROM VALIDATION
WHERE IDOBS = ?
AND IDELEVE = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Validation');

        $res = $pdo->execute(array($idObs, $idEleve));

        if($res){
            $datas = $pdo->fetchAll();
            return $datas;
        }
        else{
            throw new Exception('Erreur');
        }

    }


}