<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('mailer.inc.php');

$msg = '';

if ($_SERVER['REQUEST_METHOD']=='POST'){
   
    $username = $_POST['username']?? false;
    
    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE username = ?');
   
    $sql->execute([$username]);

    if ($sql->rowCount()){
        $token = bin2hex (random_bytes(16));

      $sql = pdo->prepare('UPDATE usuarios SET recupera_token = :token WHERE  id = id_usr');
    
      $sql -> execute([
        ':token', $token,
        ':id_usr', $usuario['id'],
      ]);
$msg = 'vai ver seu email';

 echo $twig->render('email_recupera_senha.html', [
     'token' => $token
    ]);
     die;

    }else{
        $msg = ' usuário não encontrado. F';
    }

}
echo $twig->render('recuperar_senha.html', [
    'msg'=> $msg,
]);
