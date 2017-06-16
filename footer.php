<?php

    require_once 'webpage.class.php';
    
function footer(){
    return '<footer class="footer footer-inverse bg-inverse text-muted">
            <div class="row">
                <span class="offset-sm-1 col-sm-3">' . Webpage::escapeString("© Copyright 2016/2017") . '<strong>' . Webpage::escapeString(" I.U.T Reims-Châlons-Charleville") . '</strong></span>
                <span class="offset-sm-1 col-sm-3">Chemin des Rouliers / CS30012 / 51687 REIMS CEDEX 2</span>
                <a class="offset-sm-1 col-sm-3" href="http://www.univ-reims.fr/universite/organisation/organisation,7741,18258.html?&args=v6c8KtUbgtua5qBgA22_BFRfK6yFIeIoj8EcmN3JzmQeiUvNoRi1XBSVepe_gwJU4uFsUzkOJdUDlLJudc8M3g" target="_blank"><strong><i class="fa fa-phone-square" aria-hidden="true"></i> Nous contacter</strong></a>
            </div>
        </footer>';
}