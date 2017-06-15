<?php
require_once 'myPDO.class.php';
require_once 'webpage.class.php';
require_once 'Eleve.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Classe.class.php';

$w = new Webpage('Accueil');
$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$nbAnnivAujourdhui = "Pas de nouvelles aujourd'hui.";
$user = "Utilisateur";
$img = '<img alt="image ecole" src="https://preview.ibb.co/cmNif5/Asfeld_School.jpg" style="width:90%;">';
$anniversaires = Webpage::escapeString("Veuillez vous connecter pour voir les évênements");
$titre1 = Webpage::escapeString("Ecole du Pré vers l'aisne");

if (isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"])){
    $anniversaires = "";
    $user = strtoupper(substr($_COOKIE["profFirstName"],0,1)) . substr($_COOKIE["profFirstName"],1);
    $titre1 = "Voici la liste de vos elèves";
    $img = "";
    $titre1 = "Voici la liste de vos élèves";
    $requete = <<<SQL
SELECT NOM, PRNM, DATE_FORMAT(DATNS, '%d%m') AS DATNS
FROM ELEVE
WHERE EXTRACT(Month from datNs) = EXTRACT(Month from sysdate())
ORDER BY 3;
SQL;

    $pdo = myPDO::getInstance()->prepare($requete);

    $pdo->setFetchMode(PDO::FETCH_CLASS, 'Eleve');

    $res = $pdo->execute(array());

    if($res){
        $eleves = $pdo->fetchAll();
    }
    else{
        throw new Exception('Erreur, impossible de trouver les élèves');
    }
    $mois = array(1 => "janvier", 2 => "février", 3 => "mars", 4 => "avril", 5 => "mai", 6 => "juin", 7 => "juillet", 8 => "aout", 9 => "septembre", 10 => "octobre", 11 => "novembre", 12 => "decembre");

    if ( $eleves == NULL ) {
      $anniversaires = " Il n' y a pas d'anniversaires ce mois ci." ;
    }
    else {
        for ($i = 0; $i<count($eleves); $i++) {
            $month = substr($eleves[$i]->getDateNaissance(),2,2);
            if ($month == '01' || $month == '02' || $month == '03' || $month == '04' || $month == '05' ||$month == '06' || $month == '07' ||$month == '08' || $month == '09') {
                $month = substr($month,1,1);
            }
            $anniversaires .= '<p>' . $eleves[$i]->getNom() . " " . $eleves[$i]->getPrenom() . " - Anniversaire le " . substr($eleves[$i]->getDateNaissance(),0,2) . " " . $mois[$month] . "</p>";
            if ( date('md') == $eleves[$i]->getDateNaissance() ) { $nbAnnivAujourdhui++; }
        }
    }
    if ( $nbAnnivAujourdhui != 0 ) {
      $nbAnnivAujourdhui = "Il y a " . $nbAnnivAujourdhui . " anniversaire(s) aujourd'hui.";
   }

$classes = Classe::getAll();

$ps = Classe::getStudentFromClassId($classes[0]->getId());
$ms = Classe::getStudentFromClassId($classes[1]->getId());
$gs = Classe::getStudentFromClassId($classes[2]->getId());

$taille = count($ps);
if ($taille<count($ms)) {
	$taille = count($ms);
}
if ($taille < count($gs)) {
	$taille = count($gs);
}

$tps = count($ps);
$tms = count($ms);
$tgs = count($gs);

    	$img = '<table class="text-left"><tr><th class="text-center">Petite section</th><th class="text-center">Moyenne section</th><th class="text-center">Grande section</th></tr>';
    for ($i = 0; $i<$taille; $i++) {
    	$img .= '<tr>';
    		if ($i < $tps) {
    		 $img .= '<td class="col-sm-4" style="border-right:solid;"><a href="panneladmin.php#recapeleves?id='.$ps[$i]->getId().'" style="color:black;">' . $ps[$i]->getNom() . " " . $ps[$i]->getPrenom() . '</a></td>';
    		}
    		else {
    		 $img .= '<td style="border-right:solid;"></td>';
    		}
    		if ($i < $tms) {
    		 $img .='<td class="col-sm-4" style="border-right:solid;"><a href="panneladmin.php#recapeleves?id=' . $ms[$i]->getId() . '" style="color:black;">' . $ms[$i]->getNom() . " " . $ms[$i]->getPrenom() . '</a></td>';
    		}
    		else {
    		 $img .= '<td style="border-right:solid;"></td>';
    		}
    		if ($i < $tgs) {
    		 $img .= '<td class="col-sm-4"><a href="panneladmin.php#recapeleves?id=' . $gs[$i]->getId() . '" style="color:black;">' . $gs[$i]->getNom() . " " . $gs[$i]->getPrenom() . '</a></td>';
    		}
    		else {
    		 $img .= '<td></td>';
    		}
                $img .= '</tr>';

    		}

    	$img.= '</table>';
}



$html = <<<HTML
        <div class="row col-md-12">
            <div class="col-md-12" style="height:50px;"></div>

            <div class="alert alert-info offset-md-2 col-md-8 offset-md-2 text-center" role="alert">
                <strong>Bienvenue {$user} !</strong> {$nbAnnivAujourdhui}
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
