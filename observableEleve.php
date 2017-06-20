<?php

require_once 'webpage.class.php';


$html= '<html lang="fr">
  <head>
  <meta charset="UTF-8">' ;

require_once 'myPDO.class.php';
require_once 'Observable.class.php';
require_once 'Categorie.class.php';
require_once 'Eleve.class.php';
require_once 'Validation.class.php';
require_once 'navbar.php';
require_once 'footer.php';

$w = new Webpage('Eleves');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendContent(navbar());
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');


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
              WHERE IDCATG = '{$categorie}');

SQL;

        $pdo = myPDO::getInstance()->prepare($requeteobservables);

        $pdo->setFetchMode(PDO::FETCH_BOTH);

        $res = $pdo->execute(array());

        if($res){

            $observables = $pdo->fetchAll();

        }
        else{

            throw new Exception('Erreur, aucun élève ne possède cette observable');

        }


 $html .='<div class="form-check">';

$html .= '<h2 id="title" class="offset-sm-1">Listes des observables de l&apos;élève ' . $eleve[0]->getNom() ." ".$eleve[0]->getPrenom().'</h2>
          <h3 id="title" class="offset-sm-1">Catégorie : ' . $cat[0]->getNom() . '</h3> 
          <div class="row">
            <div class="col-offset-2" style="margin-left:10%;"> 
            <form action="updateObservableEleve.php" method="GET">';

if (count($observables)!=0) {
for($i = 0; $i <count($observables); $i++) {
    $obs = Observable::createFromId($observables[$i][0]);
	$validation = Validation::createFrom2Param($id, $observables[$i][0]);

    if ($validation[0]->getValide() == 1) {
        $html .= '      <div>
                            <label class="form-check-label" style="font-weight:bold;">'.$obs[0]->getNom().'</label></br>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1" checked> Non acquis</label>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2"> En cours</label>
                                <label class="form-check-label" style="margin-bottom:20px;"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3"> Acquis</label>
                         </div>';
    }
    else if ($validation[0]->getValide() == 2) {
	   $html .= '<div>
                            <label class="form-check-label" style="font-weight:bold;">'.$obs[0]->getNom().'</label></br>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1"> Non acquis</label>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2" checked> En cours</label>
                                <label class="form-check-label" style="margin-bottom:20px;"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3"> Acquis</label>
                         </div>';
    }
    else {
        $html .= '<div>
                            <label class="form-check-label" style="font-weight:bold;">'.$obs[0]->getNom().'</label></br>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="1"> Non acquis</label>
                                <label class="form-check-label"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="2"> En cours</label>
                                <label class="form-check-label" style="margin-bottom:20px;"><input class="form-check-input" type="radio" name="'. $obs[0]->getId() .'" value="3" checked> Acquis</label>
                         </div>';
    }

}
}
else {
    $html .= '<p>Pas d&apos;observable(s) pour cette catégorie</p>';
}

$html .= '<input type="text" name="id" value="'.$id.'" style="margin-left:-99999999px;"></div></div><button id="btnvalider" class="btn btn-primary offset-sm-4 col-sm-3" type="submit">Valider</button></form></div></div>';
}
else {echo 'Impossible';}

$w->appendContent($html);
$w->appendContent(footer());
echo ($w->toHTML());