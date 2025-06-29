<?php
// Sempre que trabalhar com login/sessão, coloque isso no topo do arquivo!
session_start();

// Um "banco" de itens fictício (pode trocar por dados do professor, ou do banco de dados dele).
$items = [
    ['nome' => 'Item 1', 'descricao' => 'Primeiro item do catálogo.'],
    ['nome' => 'Item 2', 'descricao' => 'Segundo item do catálogo.'],
    ['nome' => 'Item Especial', 'descricao' => 'Um item muito especial.'],
];

// Se tiver GET com 'pesquisa', salva o texto pra filtrar.
$pesquisa = '';
if (isset($_GET['pesquisa'])) {
    $pesquisa = strtolower($_GET['pesquisa']);
}

// Filtra itens que contenham o texto digitado.
$filtrados = [];
foreach ($items as $item) {
    if ($pesquisa === '' || strpos(strtolower($item['nome']), $pesquisa) !== false) {
        $filtrados[] = $item;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Catálogo</title>

    <!-- Aqui é onde "liga" o CSS com a página. Crie o arquivo estilo.css na mesma pasta! -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Catálogo de Itens</h1>

    <!-- BLOCO DO LOGIN -->
    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']) ?>! <a href="logout.php">Sair</a></p>
    <?php else: ?>
        <!-- Este form manda os dados para login.php -->
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Login</button>
        </form>
    <?php endif; ?>

    <!-- BARRA DE PESQUISA -->
    <form method="GET">
        <input type="text" name="pesquisa" value="<?= htmlspecialchars($pesquisa) ?>" placeholder="Buscar item...">
        <button type="submit">Pesquisar</button>
    </form>

    <!-- LISTA DE ITENS (resultados da busca ou todos os itens) -->
    <ul>
        <?php if (count($filtrados) > 0): ?>
            <?php foreach ($filtrados as $item): ?>
                <li>
                    <strong><?= htmlspecialchars($item['nome']) ?></strong>: <?= htmlspecialchars($item['descricao']) ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Nenhum item encontrado.</li>
        <?php endif; ?>
    </ul>
</body>
</html>