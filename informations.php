<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';

$w = new Webpage('Informations');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$html =<<<HTML
<div class="row">
    <div class="col-md-12" style="height: 50px;"></div>
    <div class="col-sm-12">
        <div class="alert alert-info offset-md-2 col-md-8 offset-md-2 text-center" role="alert">
            Informations relatives à l'école primaire du pré vers l'Aisne
        </div>
    </div>
    <div class="col-md-12" style="height: 50px;"></div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="card text-center">
            <div class="card-header">
               <i class="fa fa-address-book fa-2x" aria-hidden="true"></i><strong> Nous contacter :</strong>
            </div>
            <div class="card-block">
                <div class="col-sm-6">
                    <div class="text-left"><i class="fa fa-question-circle fa-2x"></i><span> Type d'école : Publique</span></div>
                    <div class="text-left"><i class="fa fa-search fa-2x"></i><span> Zone : B</span></div>
                    <div class="text-left"><i class="fa fa-globe fa-2x"></i><span> Adresse : 1 rue de la Barre</span></div>
                    <div class="text-left"><i class="fa fa-location-arrow fa-2x"></i><span> Code postal : 08190</span></div>
                    <div class="text-left"><i class="fa fa-thumb-tack fa-2x"></i><span> Ville : Asfeld</span></div>
                    <div class="text-left"><i class="fa fa-phone fa-2x"></i><span> Téléphone : 03 24 72 94 66</span></div>
                    <div class="text-left"><i class="fa fa-envelope fa-2x"></i><span> Email : </span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12" id="card2">
        <iframe src="http://cache.media.education.gouv.fr/lib/men/pdf/GenerationPDF.php?url=http%253A%252F%252Fwww.education.gouv.fr%252Fexports%252FannuaireOTS.php%253Fuai%253D0080545Z%2526onglet_ots%253Dmaternelle&file_name=ots_maternelle_Asfeld_08190&options=%5B%22--footer-html%2B%2526quot%253Bhttp%253A%252F%252Fwww.education.gouv.fr%252Fexports%252FannuaireOTS_footer.php%2526quot%253B%22%2C%22--margin-bottom%2B95%22%2C%22--margin-left%2B5%22%2C%22--margin-right%2B5%22%2C%22--margin-top%2B10%22%5D" class="col-sm-12" height="100%" align="middle"></iframe>
    </div>
</div>
HTML;


$w->appendContent($html);
$w->appendContent(footer());
echo ($w->toHTML());