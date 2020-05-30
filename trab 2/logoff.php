<?php
session_start();

if(isset($_SESSION['emailCadastro'])){
    session_destroy();
    header('Location: index.php');
}
else{header('Location: index.php');}
?>