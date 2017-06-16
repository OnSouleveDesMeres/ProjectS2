<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/06/17
 * Time: 21:02
 */

require_once 'webpage.class.php';
require_once 'navbar.php';
require_once 'footer.php';
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';

if(isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"]) && isset($_COOKIE["profFirstName"]) && !empty($_COOKIE["profFirstName"])){

    $html = new WebPage('Panel administratif');
    $html->appendToHead('<link rel="icon" type="image/png" href="img/favicon.png" />');
    $html->appendCssUrl('bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css');
    $html->appendCssUrl('font-awesome-4.7.0/css/font-awesome.min.css');
    $html->appendCssUrl('css/style-paneladmin.css');

    $html->appendContent(navbar());

    $students = Eleve::getAll();
    $liste = '';
    foreach ($students as $eleve){

        $liste .= "<tr><td>{$eleve->getId()}</td><td>{$eleve->getNom()}</td><td>{$eleve->getPrenom()}</td><td>{$eleve->getVille()}</td><td>{$eleve->getCodePostal()}</td><td>{$eleve->getRue()}</td><td>{$eleve->getEmail()}</td><td>{$eleve->getNumeroTel()}</td><td>{$eleve->getDateNaissance()}</td><td><a href='eleve.php?id={$eleve->getId()}'>Modifier</a></td><td><a href='panel.php?deleteStudent={$eleve->getId()}'>Supprimer</a></td></tr>";

    }

    $observables = Observable::getAll();
    $listeObs = '';
    foreach ($observables as $obs){

        $listeObs .= "<tr><td>{$obs->getId()}</td><td>{$obs->getIdCatg()}</td><td>{$obs->getNom()}</td><td><a href='observable.php?id={$obs->getId()}'>Modifier</a></td><td><a href='panel.php?deleteObs={$obs->getId()}'>Supprimer</a></td></tr>";

    }

    $page =<<<HTML
<div class="row col-sm-12">
    <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">

        <div style="height:25px;"></div>

        <center>
            <img src="img/noavatar.png"  alt="photoprofil" width="50%" class="img-circle">
            <div style="height:25px;"></div>
            <button type="button" class="btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Éditer le profil</button>
        </center>

        <div style="height:25px;"></div>

        <ul class="nav nav-pills flex-column" id="tabprincipale" role="tablist">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#recapeleve" role="tab" aria-controls="Récap des élèves">Récapitulatif des élèves</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajoutereleve" role="tab" aria-controls="Ajouter un élève">Ajouter un élève</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recapobservable" role="tab" aria-controls="Modifier un élève">Récapitulatif des observables</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajouterobservable" role="tab" aria-controls="Ajouter une observable">Ajouter une observable</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recapobservable" role="tab" aria-controls="Modifier un élève">Récapitulatif des observables</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajouterobservable" role="tab" aria-controls="Ajouter une observable">Ajouter une observable</a></li>
        </ul>

    </nav>

    <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
        <div style="height:55px;"></div>
        <h1>Affichage des élèves :</h1>

        <div style="height:25px;"></div>

        <div class="tab-content">
            <!---------------------------------------------------------->
            <div class="tab-pane active" id="recapeleve" role="tabpanel">

                <center style="overflow-x:auto;"><div class="btn-group" role="group" aria-label="bouton trier par...">
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    </div>
                </center>

                <section class="row text-center placeholders">
                    <div style="overflow-x:auto;" class="offset-sm-1 col-sm-10 offset-sm-1 placeholder">
                        <table class="table">
                            <thead class="thead-inverse  text-center">
                                <tr>
                                    <th>id</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Ville</th>
                                    <th>Code Postal</th>
                                    <th>Adresse</th>
                                    <th>Email</th>
                                    <th>Numéro téléphone</th>
                                    <th>Date de naissance</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$liste}
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="ajoutereleve" role="tabpanel">
                <section class="row text-center placeholders">
                    <div class="offset-sm-2 col-sm-8 offset-sm-2 placeholder">
                        <form action="paneladmin.php" method="post">

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" name="datens" class="form-control" placeholder="Date de naissance (JJ/MM/AAAA)" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}">
                                </div>
                                <div class="col-sm-6">
                                    <select class="custom-select" required>
                                        <option value="" selected>Choisissez une classe</option>
                                        <option value="1">Petite section</option>
                                        <option value="2">Moyenne section</option>
                                        <option value="3">Grande section</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <h4><label for="parentsepare" class="col-6 col-form-label">Parent 1</label></h4>
                                    <input type="email" name="email" class="form-control" placeholder="unemail@exemple.com">
                                </div>
                                <div class="col-sm-6">
                                    <h4><label for="parentsepare" class="col-6 col-form-label">(Parent 2 si séparé)</label></h4>
                                    <input type="email" name="email" class="form-control" placeholder="unemail@exemple.com">
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel"  name="telephone" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$">
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel"  name="telephone" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ville1" class="form-control" placeholder="Ville" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ville2" class="form-control" placeholder="Ville">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ad1" class="form-control" placeholder="Adresse" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ad2" class="form-control" placeholder="Adresse">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="cp1" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="cp2" class="form-control" placeholder="Code postal" pattern="[0-9]{5}">
                                </div>
                            </div>
                            <div>
                                <button id="sendstudent" type="submit" class="btn btn-primary">Ajouter l'élève</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="recapobservable" role="tabpanel">
                <div class="tab-pane active" id="recapobservable" role="tabpanel">

                <center style="overflow-x:auto;"><div class="btn-group" role="group" aria-label="bouton trier par...">
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    <button type="button" class="btn btn-secondary">Trier par...</button>
                    </div>
                </center>

                <section class="row text-center placeholders">
                    <div style="overflow-x:auto;" class="offset-sm-1 col-sm-10 offset-sm-1 placeholder">
                        <table class="table">
                            <thead class="thead-inverse  text-center">
                                <tr>
                                    <th>id</th>
                                    <th>id catégorie</th>
                                    <th>Nom observable</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                {$listeObs}
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="settings" role="tabpanel">
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="settings" role="tabpanel">
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="settings" role="tabpanel">
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="settings" role="tabpanel">
            </div>
            <!---------------------------------------------------------->
        </div>

    </main>
</div>
HTML;


    $html->appendContent($page);

    $html->appendContent(footer());

    $html->appendJsUrl('https://code.jquery.com/jquery-3.1.1.slim.min.js');
    $html->appendJsUrl('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js');
    $html->appendJsUrl('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js');
    $html->appendJsUrl('js/javascript.js');

    echo $html->toHTML();

}
else{

    header('Location: login.php');

}