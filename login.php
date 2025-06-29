<?php
session_start();
$usuario_correto = 'admin';
$senha_correta = '123';

if ($_POST['usuario'] === $usuario_correto && $_POST['senha'] === $senha_correta) {
    $_SESSION['usuario'] = $_POST['usuario'];
    header('Location: index.php');
    exit;
} else {
    echo "Usuário ou senha incorretos. <a href='index.php'>Voltar</a>";
}