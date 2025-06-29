<?php
session_start();

// Usuário/senha fixos (pode mudar para dados do banco, se o professor pedir).
$usuario_correto = 'admin';
$senha_correta = '123';

// Verifica se o que foi digitado é igual ao usuário e senha corretos.
if ($_POST['usuario'] === $usuario_correto && $_POST['senha'] === $senha_correta) {
    // Se estiver correto, cria a sessão e redireciona para index.php
    $_SESSION['usuario'] = $_POST['usuario'];
    header('Location: index.php');
    exit;
} else {
    // Se errado, mostra mensagem e link pra voltar
    echo "Usuário ou senha incorretos. <a href='index.php'>Voltar</a>";
}