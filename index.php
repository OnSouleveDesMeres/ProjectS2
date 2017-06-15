<?php
require_once 'myPDO.class.php';
require_once 'webpage.class.php';
require_once 'Eleve.class.php';
require_once 'navbar.php';
require_once 'footer.php';

$w = new Webpage('Accueil');
$w->setTitle('Administration');
$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');     
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$user = "Utilisateur";
$img = '<img alt="image ecole" src="http://www.asfeldjuzancourt.fr/uploads/1/0/0/4/100441872/published/ecole-primaire_1.jpg?1487146157" style="height:100%;width:100%;">';
$anniversaires = Webpage::escapeString("Pas d'événements prévus d'ici un mois");
$titre1 = Webpage::escapeString("Ecole du Pré vers l'aisne");

if (isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"])){
    $anniversaires = "";
    $user = Webpage::escapeString($_COOKIE["profFirstName"]);
    $titre1 = Webpage::escapeString("Voici la liste de vos elèves");
    $requete = <<<SQL
SELECT NOM, PRNM, DATE_FORMAT(DATNS, '%d%m') AS DATNS
FROM ELEVE
WHERE EXTRACT(Month from datNs) between EXTRACT(Month from sysdate()) AND EXTRACT(Month from sysdate())+1
ORDER BY 3;
SQL;

    $pdo = myPDO::getInstance()->prepare($requete);

    $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

    $res = $pdo->execute(array());

    if($res){
        $eleves = $pdo->fetchAll();
    }
    else{
        throw new Exception('Erreur, impossible de récupérer les élèves');
    }
    $mois = array(1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai", 6 => "juin", 7 => "juillet", 8 => "aout", 9 => "septembre", 10 => "octobre", 11 => "novembre", 12 => "decembre");


    for ($i = 0; $i<count($eleves); $i++) {
        $month = substr($eleves[$i]->getDateNaissance(),2,2);
        if ($month == '01' || $month == '02' || $month == '03' || $month == '04' || $month == '05' ||$month == '06' || $month == '07' ||$month == '08' || $month == '09') {
            $month = substr($month,1,1);
        }
        $anniversaires .= '<p>' . $eleves[$i]->getNom() . " " . $eleves[$i]->getPrenom() . " - Anniversaire le " . substr($eleves[$i]->getDateNaissance(),0,2) . " " . $mois[$month] . "</p>";
    }
}

$html = <<<HTML
        <div class="row col-md-12">
            <div class="col-md-12" style="height:50px;"></div>

            <div class="alert alert-info offset-md-2 col-md-8 offset-md-2 text-center" role="alert">
                <strong>Bienvenue {$user} !</strong> Pas de nouvelles aujourd&#39;hui.
            </div>
HTML;

$html .= '<div class="col-md-12" style="height:50px;"></div>
            <div class="col-md-6 offset-md-1">
                <div class="card text-center">
                    <div class="card-header"> 

                       <i class="fa fa-graduation-cap" aria-hidden="true"></i> ' . $titre1 . '
                 </div>
                    <div class="card-block">
                        '.$img.'
                    </div>
                </div>
            </div>

            <div id="card2" class="offset-md-1 col-md-3 offset-md-1">
                <div class="card text-center">
                    <div class="card-header">
                       <i class="fa fa-users" aria-hidden="true"></i>' . Webpage::escapeString(" Événements ce mois ci :") . '
                    </div>
                    <div class="card-block">';

$html .= $anniversaires;

$html .= '
                    </div>
                </div>
            </div>
        </div>
'.footer();

$w->appendContent($html);
echo ($w->toHTML());