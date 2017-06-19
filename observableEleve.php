<?php

$html= '<html lang="fr">
  <head>
  <meta charset="UTF-8">' ;

require_once 'myPDO.class.php';
require_once 'Observable.class.php';
require_once 'Categorie.class.php';
require_once 'Eleve.class.php';
require_once 'Validation.class.php';


if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['categorie']) && !empty($_GET['categorie'])) {

$id = $_GET['id'];
$categorie = $_GET['categorie'];

$cat = Categorie::createFromId($categorie);
$eleve = Eleve::createFromId($id);

$requeteobservables = <<<SQL
SELECT *
FROM VALIDATION v
WHERE v.IDELEVE = $id
AND IDOBS IN (SELECT IDOBS
              FROM OBSERVABLE
              WHERE IDCATG = $categorie);

SQL;

        $pdo = myPDO::getInstance()->prepare($requeteobservables);

        $pdo->setFetchMode(PDO::FETCH_BOTH);

        $res = $pdo->execute(array($id));

        if($res){

            $observables = $pdo->fetchAll();

        }
        else{

            throw new Exception('Erreur, aucun élève ne possède cette observable');

        }

 $html .='<div class="form-check">';

$html .= '<h2>Listes des observables de l&apos;élève ' . $eleve[0]->getNom() ." ".$eleve[0]->getPrenom().'</h2>
          <h3>Catégorie : ' . $cat[0]->getNom() . '</h3> 
            <div class="form-check">';

for($i = 0; $i <count($observables); $i++) {
    $obs = Observable::createFromId($observables[$i][0]);
	$validation = Validation::createFrom2Param($id, $observables[$i][0]);

    if ($validation[0]->getValide() == 1) {
        $html .= '<li style="margin-top:20px;">'.$obs[0]->getNom().'</br><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1" checked>Non acquis
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2">En cours
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3">Acquis';
    }
    else if ($validation[0]->getValide()) {
	   $html .= '<li style="margin-top:20px;">'.$obs[0]->getNom().'</br><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1" checked>Non acquis
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2" checked>En cours
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3">Acquis';
    }
    else {
        $html .= '<li style="margin-top:20px;">'.$obs[0]->getNom().'</br><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1">Non acquis
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2">En cours
                                <input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3" checked>Acquis';
    }


}

$html .= '</ul>';
}
else {echo 'Impossible';}

echo $html;