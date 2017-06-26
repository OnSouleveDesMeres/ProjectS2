<?php

    require_once 'webpage.class.php';
    
function footer(){
    $d = date('Y');
    return '<footer class="footer footer-inverse bg-inverse text-muted">
            <div class="row">
                <span class="offset-sm-1 col-sm-3">' . Webpage::escapeString("© Copyright 2016/{$d}") . '<strong>' . Webpage::escapeString(" Powered by Darweak") . '</strong></span>
                <span class="offset-sm-1 col-sm-3">Rue de la Procession / 51100 REIMS</span>
                <a class="offset-sm-1 col-sm-3" href="http://combraquesylvain.tk" target="_blank"><strong><i class="fa fa-phone-square" aria-hidden="true"></i> Me contacter</strong></a>
            </div>
        </footer>';
}