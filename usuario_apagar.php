<?php
require ('twig_carregar.php');

require ('pdo.inc.php');

//rotina de post para apagar usuario
if ($_SERVER['REQUEST_METHOD']=='POST'){
    //MODIFICA O USUARIO PAA ATIVO 0
    $id = $_POST['id'] ?? false;
    if ($id){
        $sql = $pdo->prepare('UPDATE usuarios SET ativo = 0 WHERE id = ?');
        $sql->execute([$id]);
}

header('location:usuarios.php');
die;}
//rotina de get mostrar informações da tela 

//busca usuario no banco para mostrar o nome dele

$id= $_GET['id']?? false;

$sql = $pdo->prepare('SELECT * FROM usuarios WHERE id = ?');

$sql->execute([$id]);

$usuario = $sql->fetch(PDO::FETCH_ASSOC);

echo $twig->render ('usuario_apagar.html', ['usuario' => $usuario,]);
