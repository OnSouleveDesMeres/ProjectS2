<?php
require_once 'myPDO.class.php';
require_once 'webpage.class.php';
require_once 'Eleve.class.php';
//require_once 'navbar.php';

$w = new Webpage('Accueil');
$w->setTitle('Administration');
$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');     
$w->appendContent(NAVBAR);
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


$mois = array(01 => "janvier", 02 => "février", 03 => "mars", 04 => "avril", 05 => "mai", 06 => "juin", 07 => "juillet", 08 => "aout", 09 => "septembre", 10 => "octobre", 11 => "novembre", 12 => "decembre");      

    
for ($i = 0; $i<count($eleves); $i++) {
    $html .= '<p>' . $eleves[$i]->getNom() . " " . $eleves[$i]->getPrenom() . " - Anniversaire le " . substr($eleves[$i]->getDateNaissance(),0,2) . " " . $mois[substr($eleves[$i]->getDateNaissance(),2,2)] . "</p>"
        . $mois[01];
}

$html .= '
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-inverse bg-inverse">
            <div class="container">
                <span class="text-muted">Salut bande de petits zboub</span>
            </div>
        </footer>
';

$w->appendContent($html);
$w->appendContent(FOOTER);
echo ($w->toHTML());