<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13/06/17
 * Time: 14:04
 */

class Users{

    protected $IDUSER = null;
    protected $PASSWORD = null;

    public function getId(){
        return $this->IDUSER;
    }
    public function getPassword(){
        return $this->PASSWORD;
    }

    public static function createFromId($id){
        $requete =<<<SQL
SELECT *
FROM USERS
WHERE IDUSERS = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Users');

        $res = $pdo->execute(array($id));

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{
            throw new Exception('Erreur aucun user trouvé');
        }

    }

}