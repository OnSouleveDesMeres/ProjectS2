<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/06/17
 * Time: 01:47
 */

require_once 'vendor/autoload.php';
require_once('vendor/tecnickcom/tcpdf/examples/tcpdf_include.php');
require_once 'Eleve.class.php';
require_once 'Categorie.class.php';
require_once 'Observable.class.php';
require_once 'Classe.class.php';

if (isset($_COOKIE['profId']) && !empty($_COOKIE['profId'])){

    if (isset($_GET['id']) && !empty($_GET['id'])){

        $id = $_GET['id'];

        $categories = Categorie::getFirst();
        $student = Eleve::createFromId($id);
        $classe = Classe::createFromId($student[0]->getIdClass());


        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Ecole du pré vers l\'Aisne');
        $pdf->SetTitle('Fiche de l\'élève');

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor

        // add a page
        $pdf->AddPage();

        $pdf->Image('img/noavatar.png', "130", "35", "50", "50");

        $html =<<<HTML
    <center><h1> Livret scolaire </h1></center>
    <div class="col-sm-6">
        Nom : {$student[0]->getNom()}
    </div>
    <div class="col-sm-6">
        Prénom : {$student[0]->getPrenom()}
    </div>
    <div class="col-sm-6">
        Date de naissance : {$student[0]->getDateNaissance()}
    </div>
    <div class="col-sm-6">
        Classe : {$classe[0]->getNom()}
    </div>
    <div class="col-sm-6">
        Adresse : {$student[0]->getRue()}
    </div>
    <div class="col-sm-6">
        CP : {$student[0]->getCodePostal()}
    </div>
    <div class="col-sm-6">
        Ville : {$student[0]->getVille()}
    </div>
    <div class="col-sm-6">
        Numéro de téléphone : {$student[0]->getNumeroTel()}
    </div>
    
    <div style="height:50px;" >
    
    </div>
    
    <div>
    
          <table style="border: 1px solid black">
            <thead class="thead-default">
              <tr style="border">
                <th colspan="12" style="background-color: #000000"><p style="text-align: center; color: #FFFFFF;">NOM categorie mere</p></th>
              </tr>
            </thead>
          <tr style="background-color: #eceeef">
            <th colspan="6"><p style="text-align: left;"> Categorie fille niv 1 </p></th>
            <th colspan="2"><p style="text-align: center;">non-validé</p></th>
            <th colspan="2"><p style="text-align: center;">en cours d'acquisation</p></th>
            <th colspan="2"><p style="text-align: center;">Validé</p></th>

          </tr>
        <tr>
          <th colspan="1"></th>
          <th colspan="11" style="text-align : center;">Categorie fille niv 2 </th>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="4" style="text-align : right;">  Nom observable </td>
          <td colspan="2"></td>
          <td colspan="2"></td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="4" style="text-align : right;">  Nom observable </td>
          <td colspan="2"></td>
          <td colspan="2"></td>
          <td colspan="2"></td>
        </tr>
        <tr >
            <th colspan="1"></th>
          <th colspan="11" style="text-align : center;">Categorie fille niv 2 </th>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="4" style="text-align : right;">  Nom observable </td>
          <td colspan="2"></td>
          <td colspan="2"></td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="4" style="text-align : right;">  Nom observable </td>
          <td colspan="2"></td>
          <td colspan="2"></td>
          <td colspan="2"></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="4" style="text-align : right;">  Nom observable </td>
          <td colspan="2"></td>
          <td colspan="2"></td>
          <td colspan="2"></td>
        </tr>
          </table>
    </div>
    
    <table style="border:1px solid black;">
    <tr>
    <th>Appréciation générale</th><th></th>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    </table>
    
    <div class="offset-sm-8 col-sm-3 offset-sm-1" style="height:10px;" >
           Date et signature de l'enseignant :
    </div>
HTML;

        $pdf->writeHTML($html, true, false, true, false, '');
        // add a page
        $pdf->AddPage();

        // reset pointer to the last page
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output("{$student[0]->getNom()}{$student[0]->getPrenom()}.pdf", 'I');

    }
    else{
        header('Location: panel.php');
    }

}
else{

    header('Location: index.php');

}