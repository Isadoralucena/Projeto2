<?php

use Projeto\Glau\Models\User;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //SALVAR USUÁRIO E REDIRECIONAR PARA DASHBOARD
    if (!empty($_POST['username']) && !empty($_POST['password'])) {//se existir algo nos inputs (não estiverem vázios)

        $user = new User($_POST['username'], $_POST['password']);//$user recebe instância de User, inicializando seus valores
        //para não existir users iguais
        if (!User::exists($_POST['username'], $_POST['password'])) {
            $user->save();

            //registra sessão do usuário
            session_start();
            $_SESSION['user']= $_POST['username'];
            $_SESSION['id']= session_id() . $_POST['username'];
            header("Location: /dashboard", true, 302);
            exit;
        } else {
            header("Location: /login", true, 302);//se já existe o user, ele faz login
            exit;
        }
    }
} 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastre-se</title>
</head>
<body class="logLogin">
    <style>
    <?php include"css/style.css"?>
    </style>
    <h1>Registro de usuários</h1>
    <form action="/register" method="POST">
        <input type="text" name="username" placeholder="Digite seu usuário">
        <input type="password" id="senha"  name="password" placeholder="Digite sua senha">
        <button>Enviar</button>
    </form>   
    <a href="/login">Já tem uma conta?</a>
    <form action="/login" method="GET">
        <button>Voltar</button>
    </form>
</body>
</html>