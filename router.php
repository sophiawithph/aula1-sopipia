<?php

$pagina = $_GET['pagina'] ?? false;

echo 'você chegou ao router<br>';
echo $pagina;

$include = filter_var("{$pagina}.php", FILTER_SANITIZE_STRING);

if(!file_exists($include)){
echo 'que feio isso!!!';
die;
}

require("{$pagina}.php");
