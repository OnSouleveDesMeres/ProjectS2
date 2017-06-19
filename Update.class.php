<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15/06/17
 * Time: 15:10
 */

require_once 'myPDO.class.php';

class Update{

    public static function updateStudent($id, $chp, $value){
        if($chp)

        $requete =<<<SQL
UPDATE ELEVE SET $chp = '{$value}'
WHERE IDELEVE = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function updateProf($id, $chp, $value){
        if($chp)

            $requete =<<<SQL
UPDATE PROFESSEUR SET $chp = '{$value}'
WHERE IDPROF = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function updateObs($id, $chp, $value){
        if($chp)

            $requete =<<<SQL
UPDATE OBSERVABLE SET $chp = $value
WHERE IDOBS = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function updateClass($id, $chp, $value){
        if($chp)

            $requete =<<<SQL
UPDATE CLASSE SET $chp = $value
WHERE IDCLASSE = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function updateCategory($id, $chp, $value){
        if($chp)

            $requete =<<<SQL
UPDATE CATEGORIE SET $chp = $value
WHERE IDCATG = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

    public static function updateUser($id, $chp, $value){
        if($chp)

            $requete =<<<SQL
UPDATE USERS SET $chp = '{$value}'
WHERE IDUSER = $id
SQL;

        myPDO::getInstance()->query($requete);

    }

}