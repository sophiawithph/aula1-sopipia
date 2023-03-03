<?php
    # login_verifica.php
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if ($user == 'rafael' && $pass == '123') {
        // Login feito com sucesso

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['user'] = 'Rafael';
        
        // Redireciona o usuário
        header('location:boasvindas.php');
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }