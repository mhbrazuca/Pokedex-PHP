<?php
session_start();
$items = [
    ['nome' => 'Item 1', 'descricao' => 'Primeiro item do catálogo.'],
    ['nome' => 'Item 2', 'descricao' => 'Segundo item do catálogo.'],
    ['nome' => 'Item Especial', 'descricao' => 'Um item muito especial.'],
];

$pesquisa = '';
if (isset($_GET['pesquisa'])) {
    $pesquisa = strtolower($_GET['pesquisa']);
}

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
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h1>Catálogo de Itens</h1>

    <?php if (isset($_SESSION['usuario'])): ?>
        <p>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']) ?>! <a href="logout.php">Sair</a></p>
    <?php else: ?>
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit">Login</button>
        </form>
    <?php endif; ?>

    <form method="GET">
        <input type="text" name="pesquisa" value="<?= htmlspecialchars($pesquisa) ?>" placeholder="Buscar item...">
        <button type="submit">Pesquisar</button>
    </form>

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