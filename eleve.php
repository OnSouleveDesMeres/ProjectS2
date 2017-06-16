<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Eleve.class.php';
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

if(isset($_GET['id']) && !empty($_GET['id']))


$html = <<<HTML
	<div class="row">
		<div class="offset-sm-1" style="margin-top:50px;">
			<ul class="list-group">
			  <li class="list-group-item">Nom : {$eleve[0]->getNom()}</li>
			  <li class="list-group-item">Prénom : {$eleve[0]->getPrenom()}</li>
			  <li class="list-group-item">Email : {$eleve[0]->getEmail()}</li>
			  <li class="list-group-item">Téléphone : {$eleve[0]->getNumeroTel()}</li>
			  <li class="list-group-item">Ville : {$eleve[0]->getVille()}</li>
			  <li class="list-group-item">Code postal : {$eleve[0]->getCodePostal()}</li>
			  <li class="list-group-item">Rue : {$eleve[0]->getRue()}</li>
			  <li class="list-group-item">Date de naissance : {$eleve[0]->getDateNaissance()}</li>
			  <li class="list-group-item">Email 2 : {$eleve[0]->getEmail2()}</li>
			  <li class="list-group-item">Téléphone 2 : {$eleve[0]->getNumeroTel2()}</li>
			  <li class="list-group-item">Ville 2 : {$eleve[0]->getVille2()}</li>
			  <li class="list-group-item">Code postal 2: {$eleve[0]->getCodePostal2()}</li>
			  <li class="list-group-item">Rue 2: {$eleve[0]->getRue2()}</li>
			  <li class="text-center" style="list-style:none;"><a href="profileEleve.php?id={$id}"><button class="btn btn-primary">Editer le profil de l&apos;élève</button></a></li> 
			</ul>
		</div>
		<div id="card3" class = "offset-sm-1 card" style="margin-top:50px;">
			<div class="form-group container" style="margin:10px;">
                <form action="eleve.php">
                    {$content}{$liste}
                </form>
            </div>
        </div>
    </div>
HTML;


}
else {
	$html = '<div class="col-sm-12"><div class="offset-md-3 col-md-6 offset-md-3 col-sm-12"><div class="alert alert-danger text-center">Erreur, aucun élève ne correspond à la recherche, veuillez retourner à la page précédente !</div></div></div>';
}


$html .= '</div>';

$w->appendContent($html);
$w->appendContent(footer());
$w->appendJs('jQuery(function() {
    jQuery("#category").change(function() {
        this.form.submit();
    });
});');
$w->appendJs('jQuery(function() {
    jQuery("#observable").change(function() {
        this.form.submit();
    });
});');
echo ($w->toHTML());