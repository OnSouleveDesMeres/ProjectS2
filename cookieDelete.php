<?php


setcookie("profId", "" , time()-99999) ;

setcookie("profFirstName", "" , time()-99999);

header( 'Location: index.php');
