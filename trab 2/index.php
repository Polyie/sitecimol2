<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./style/style.css" />

    <title>Sistema de Login</title>

</head>

<body>

<h1 id="topo">Sistema de Login com PHP</h1>

    <?php
date_default_timezone_set("America/Sao_Paulo");

if(!isset($_SESSION['emailCadastro'])){
?>
    <!-- FORMULARIO  -->
<div id='area'>
    <form id="form-aluno" name="formulario" method="POST">

        <h1 id="titulo"> LOGIN </h1>
            <!-- EMAIL  -->
            <label for="email">Insira seu Email:</label><br>
            <input required name="emailCadastro" type="email"><br>
            <!-- SENHA  -->
            <label for="senha">Insira sua Senha:</label><br>
            <input required name="senha" type="password" minlength="8"><br> 
            <!-- BOTÃO  -->
            <input id="inpSubmit" type="submit" name="send" value="Logar">
            <p id="msg"><a href="cadastro.php">Nova conta</a></p>

    </form>
    
</div>


    <?php 
    $usuario = "Não registrado";

    // VALIDAÇÃO

    if(isset($_POST['send'])){

    if(!$email = filter_input(INPUT_POST, 'emailCadastro', FILTER_VALIDATE_EMAIL)){
    }
    $senhaFinal = md5($_POST['senha']);
    $flag = 0;
    $arquivoAbrir = fopen('usuarios.txt', 'r+');
    

    while(!feof($arquivoAbrir)){
        $tentativa = fgets($arquivoAbrir, 2048);
        if ($tentativa == null) break;

        $dadosUsuario = explode("|", $tentativa);

        $emailRegistrado = $dadosUsuario['1'];
        $senhaRegistrada = $dadosUsuario['2'];

        if($emailRegistrado == $email && $senhaRegistrada == $senhaFinal){
            $flag = 1;
            $_SESSION["emailCadastro"]=$_POST['emailCadastro'];
            // REFRESH DA PAGINA
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0' URL='index.php'/>";

        }
    }
    if($flag == 0){
        echo "<div id='mensagem'><h1> Dados Incorretos!! </h1></div>";
    }
    }
    
}else{

    $arquivoAbrir = fopen('usuarios.txt', 'r+');
    $email = $_SESSION["emailCadastro"];
    while(!feof($arquivoAbrir)){
        $tentativa = fgets($arquivoAbrir, 2048);
        if ($tentativa == null) break;

        $dadosUsuario = explode("|", $tentativa);

        $nomeRegistrado = $dadosUsuario['0'];
        $emailRegistrado = $dadosUsuario['1'];

        if($email == $emailRegistrado){
            $nomeUsuario = $nomeRegistrado;
        }

    }

    echo "<div id='logado'><h1 id='bemvindo'> Bem vindo ". $nomeUsuario ."!</h1>";
    echo "<p>Parabéns!<p>";
    echo "<p>Você logou com sucesso, aproveite seu tempo logado, e caso queira deslogar, basta clicar <a href='logoff.php' >AQUI!</a></p></div>";
}
?>
</body>
</html>