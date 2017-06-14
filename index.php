<?php
require_once 'myPDO.class.php';
require_once 'webpage.class.php';
require_once 'Eleve.class.php';
require_once 'navbar.php';

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
        
$html = <<<HTML
        <div class="row col-md-12">
            <div class="col-md-12" style="height:50px;"></div>

            <div class="alert alert-info offset-md-2 col-md-8 offset-md-2 text-center" role="alert">
                <strong>Bienvenue %utilisateur% !</strong> Pas de nouvelles aujourd&#39;hui.
            </div>
HTML;

$html .= '<div class="col-md-12" style="height:50px;"></div>
            <div class="col-md-6 offset-md-1">
                <div class="card text-center">
                    <div class="card-header">

                       <i class="fa fa-graduation-cap" aria-hidden="true"></i> %Nom école% (si non connecté) / Voici vos étudiants de la classe %classe% (si connecté)
                 </div>
                    <div class="card-block">
                        <img src="" alt="image-école">
                    </div>
                </div>
            </div>

            <div class="offset-md-1 col-md-3 offset-md-1">
                <div class="card text-center">
                    <div class="card-header">
                       <i class="fa fa-users" aria-hidden="true"></i>' . Webpage::escapeString("Événements ce mois ci :") . '
                    </div>
                    <div class="card-block">';

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
    if ($month == 01 || $month == 02 || $month == 03 || $month == 04 || $month == 05 ||$month == 06 || $month == '07' ||$month == 08 || $month == 09) {
        $month = substr($month,1,1);
    }
    $html .= '<p>' . $eleves[$i]->getNom() . " " . $eleves[$i]->getPrenom() . " - Anniversaire le " . substr($eleves[$i]->getDateNaissance(),0,2) . " " . $mois[$month] . "</p>";
}

$html .= '
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-inverse bg-inverse text-muted">
            <div class="row">
                <span class="offset-sm-1 col-sm-3"> ' . Webpage::escapeString("© Copyright 2016/2017") .  '<strong>' . Webpage::escapeString(" I.U.T Reims-Châlons-Charleville") . '</strong></span>
                <span class="offset-sm-1 col-sm-3">Chemin des Rouliers / CS30012 / 51687 REIMS CEDEX 2</span>
                <a class="offset-sm-1 col-sm-3" href="http://www.univ-reims.fr/universite/organisation/organisation,7741,18258.html?&args=v6c8KtUbgtua5qBgA22_BFRfK6yFIeIoj8EcmN3JzmQeiUvNoRi1XBSVepe_gwJU4uFsUzkOJdUDlLJudc8M3g" target="_blank"><strong><i class="fa fa-phone-square" aria-hidden="true"></i> Nous contacter</strong></a>
            </div>
        </footer>
';

$w->appendContent($html);
echo ($w->toHTML());