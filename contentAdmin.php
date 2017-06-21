<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18/06/17
 * Time: 23:48
 */

require_once 'Professeur.class.php';

function getContent(){

    $professeurs = Professeur::getAll();

    $tabProf = '';

    $listeProf = '';

    foreach ($professeurs as $professeur){
        $listeProf .= "<option value='{$professeur->getId()}'>{$professeur->getNom()} {$professeur->getPrenom()}</option>";
        $tabProf .= "<tr><td>{$professeur->getNom()}</td><td>{$professeur->getPrenom()}</td><td>{$professeur->getVille()}</td><td>{$professeur->getCodePostal()}</td><td>{$professeur->getRue()}</td><td>{$professeur->getEmail()}</td><td>{$professeur->getNumeroTel()}</td><td>{$professeur->getDateNaissance()}</td><td><a href='panel.php?deleteProf={$professeur->getId()}'>Supprimer</a></td></tr>";
    }
    $html =<<<HTML

            <!---------------------------------------------------------->
            <div class="tab-pane" id="recapprof" role="tabpanel">
                <h1>Affichage des professeurs :</h1>
        
                <div style="height:25px;"></div>
                    <div style="overflow-x:auto;" class="btn-group offset-sm-3 col-sm-6" role="group" aria-label="bouton trier par...">
                        <input id="searchbar" type="text" class="search form-control" placeholder="Rechercher un professeur ?">
                    </div>

                <div class="tab-pane active" id="recapprof" role="tabpanel">
    
                    <section class="row text-center placeholders">
                        <div style="overflow-x:auto;" class="col-sm-12 placeholder">
                            <table class="table">
                                <thead class="thead-inverse  text-center">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Ville</th>
                                        <th>Code Postal</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Numéro téléphone</th>
                                        <th>Date de naissance</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {$tabProf}
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
            <!---------------------------------------------------------->
            <div class="tab-pane" id="ajoutprof" role="tabpanel">
                <h1>Ajouter un professeur :</h1>
        
                <div style="height:25px;"></div>

                <section class="row text-center placeholders">
                    <div class="offset-sm-2 col-sm-8 offset-sm-2 placeholder">
                        <form action="panel.php" method="post">

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="text" name="nomp" class="form-control" placeholder="Nom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="prenomp" class="form-control" placeholder="Prénom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" name="datensp" class="form-control" placeholder="Date de naissance (AAAA-MM-JJ)" required pattern="19[0-9]{2}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|2[0-9]|3[01])">
                                </div>
                                <div class="col-sm-6">
                                    <select class="custom-select" name="profSup">
                                        <option value="" selected>Choisissez un supérieur</option>
                                        {$listeProf}
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" name="email" class="form-control" placeholder="unemail@exemple.com">
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel"  name="telephone" class="form-control" placeholder="N° de téléphone" pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ville" class="form-control" placeholder="Ville" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="ad" class="form-control" placeholder="Adresse" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="cp" class="form-control" placeholder="Code postal" pattern="[0-9]{5}" required>
                                </div>
                            </div>
                            <div>
                                <button id="sendstudent" type="submit" class="btn btn-primary">Ajouter le professeur</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
HTML;

    return $html;

}

function getNavLinks(){
    $html =<<<HTML

            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recapprof" role="tab" aria-controls="Lister les professeurs">Récapitulatif des professeurs</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ajoutprof" role="tab" aria-controls="Ajouter un professeur">Ajouter un professeur</a></li>
HTML;

    return $html;
}