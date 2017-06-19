<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Observable.class.php';
require_once 'Categorie.class.php';

$w = new Webpage('Eleves');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$html='';

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $observable = Observable::createFromId($id);
    $Categorie = Categorie::createFromId($observable[0]->getIdCatg());
    $Categories = Categorie::getAll();
    $html .= <<<HTML
    <div style="height:15px;"></div>
    <form name="Observable" method="GET" action="updateObservable.php">

            <div class="offset-md-3 col-sm-6"> 
            <label>Nom :</label>               
            </div>
            
            <div class="input-group offset-sm-3 col-sm-6">            	
                <span class="input-group-addon"><i class="fa fa-align-justify" aria-hidden="true"></i></span>
                <input type="text" name="nom" class="form-control" placeholder="Nom" value="{$observable[0]->getNom()}" required>
            </div>

            <div class="form-group offset-sm-3 col-sm-6">
		    <label for="exampleSelect1">Catégorie :</label>
			    <select class="form-control" id="categorie" value="{$Categorie[0]->getNom()}">
HTML;
		foreach($Categories as $c) {
			$html .= '<option>' . $c->getNom() . '</option>';
		}

$html .= <<<HTML
		</select>
		</div>	
		  </div>
            	<input type="text" name="id" style="margin-left:-9999999px;" value="{$id}">
            
            <div style="height:15px;"></div>
        </form>

HTML;
}
else{
    $html .= '<h1>Erreur observable introuvable</h1>';
}


$w->appendContent($html);
$w->appendContent(footer());
echo ($w->toHTML());