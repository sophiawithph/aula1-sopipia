<?php
require('twig_carregar.php');

if( $_SERVER['REQUEST_METHOD']==!$_FILES['arquivo']['error']){
    move_uploaded_file($_FILES['arquivo']['tmp_name'],'uploads/'. $_FILES['arquivo']['name']);
}



echo $twig->render('documentos_novo.html');