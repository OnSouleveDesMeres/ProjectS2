<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/06/17
 * Time: 10:53
 */

require_once 'myPDO.class.php';
require_once 'Eleve.class.php';

class Classe{

    protected $IDCLASSE = null;

    protected $LIBCLASSE = null;

    public function getId(){
        return $this->IDCLASSE;
    }

    public function getNom(){
        return $this->LIBCLASSE;
    }

    /**
     * @param id de la classe
     * @return tableau d'instance d'élève
     * @throws Exception
     */
    public static function createFromId($id){

        $requete = <<<SQL
SELECT *
FROM CLASSE c
WHERE c.IDCLASSE = ?
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Classe');

        $res = $pdo->execute(array($id));

        if ($res) {
            $datas = $pdo->fetchAll();
            return $datas;
        } else {
            throw new Exception('Erreur, impossible de récupérer les élèves de cette classe');
        }

    }

    /**
     * Permet de récupérer la liste des élèves d'une certaine classe triés par nom.
     *
     * @param id classe
     * @return tableau d'instance d'élèves
     * @throws Exception
     */
    public static function getStudentFromClassId($id)
    {

        $requete = <<<SQL
SELECT *
FROM ELEVE e, CLASSE c
WHERE e.IDCLASSE = ?
AND e.IDCLASSE = c.IDCLASSE
ORDER BY NOM
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

        $res = $pdo->execute(array($id));

        if ($res) {
            $datas = $pdo->fetchAll();
            return $datas;
        } else {
            throw new Exception('Erreur, impossible de récupérer les élèves de cette classe');
        }

    }

    public static function getAll(){

        $requete =<<<SQL
SELECT *
FROM CLASSE
SQL;

        $pdo = myPDO::getInstance()->prepare($requete);

        $pdo->setFetchMode(PDO::FETCH_CLASS, 'Classe');

        $res = $pdo->execute(array());

        if ($res){

            $datas = $pdo->fetchAll();
            return $datas;

        }
        else{

            throw new Exception('Erreur, impossible de récupérer les classes');

        }

    }

}