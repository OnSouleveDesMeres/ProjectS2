<?php
require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Professeur.class.php';

$w = new Webpage('Profile');

$w->appendCssURL('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
$w->appendCssURL('font-awesome-4.7.0/css/font-awesome.min.css');
$w->appendCssURL('css/style-accueil.css');
$w->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
$w->appendContent(navbar());
$w->appendJsURL('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"');
$w->appendJsURL('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"');
$w->appendJsURL('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"');
$w->appendJsURL('js/javascript.js');

$html = "";


if (isset($_COOKIE["profId"]) && !empty($_COOKIE["profId"])){
    $professeur = Professeur::createFromId($_COOKIE["profId"]);


$html = <<<HTML
<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
		<div class="card-header">
   			Nom
  		</div>
		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getNom()} </div>
		<div class="text-right col-sm-4">
			 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapeNom" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			</div>
			</div> 
				<div class="collapse" id="collapeNom">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Nouveau nom" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
	<div class="card-header">
   			Prénom
  		</div>
		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getPrenom()} </div>
		<div class="text-right col-sm-4">
			 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapsePrenom" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			</div>
			</div>
				<div class="collapse" id="collapsePrenom">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Nouveau prénom" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
	<div class="card-header">
   			Email
  		</div>
		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getEmail()} </div>
		<div class="text-right col-sm-4">
			 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseEmail" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			</div>
			</div>
				<div class="collapse" id="collapseEmail">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Nouvel email" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
	<div class="card-header">
   			Téléphone
  		</div>
		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getNumeroTel()} </div>
		<div class="text-right col-sm-4">
			 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseTel" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			 </div>
			 </div>
				<div class="collapse" id="collapseTel">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Numéro de téléphone" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
	<div class="card-header">
   			Code Postal
  		</div>
  		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getCodePostal()} </div>
		<div class="text-right col-sm-4">
				<button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseCP" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier
				</button>
		</div>
		</div>
				<div class="collapse" id="collapseCP">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Nouveau code postal" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>			
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
	<div class="card-header">
   			Rue
  		</div>
		<div class="row">
		<div class="col-sm-8">{$professeur[0]->getRue()} </div>
		<div class="text-right col-sm-4">
			 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseRue" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			</div> 
			</div>
				<div class="collapse" id="collapseRue">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="Nouvelle rue" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
	<div class ="card offset-md-4 col-md-4 offset-md-4">
    <div class="card-header">
   			Date de naissance
  		</div>
  			<div class="row">
			<div class="col-sm-8">{$professeur[0]->getDateNaissance()} </div>
			<div class="text-right col-sm-4">
				 <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseDatNs" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</button>
			</div>
			</div>
				<div class="collapse" id="collapseDatNs">
					<div class="row">
	  					<form method="post" action="cookieConnection.php">
	                        <div class="form-group">
	                            <input type="text" placeholder="jj/mm/yyyy" name="id" required>                                
	                            <button class="btn btn-primary " type="submit">Valider</button>
	                        </div>
	                 	</form>
	   				</div>
				</div>
			</div>
		</div>
	</div>
HTML;

		$html .= '</div>';
}

$html.= "<script>$('.collapse').collapse('hide')</script>";
$w->appendContent($html);
$w->appendContent(footer());
echo ($w->toHTML());