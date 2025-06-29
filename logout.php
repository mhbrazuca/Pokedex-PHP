<?php
session_start();
// Destroi a sessão (deslogar)
session_destroy();
// Redireciona de volta para index.php
header('Location: index.php');
exit;