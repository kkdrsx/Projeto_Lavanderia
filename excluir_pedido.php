

<?php
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['pedidos'][$id])) {
        unset($_SESSION['pedidos'][$id]);
        $_SESSION['pedidos'] = array_values($_SESSION['pedidos']);
    }
}

header("Location: painel.php");
exit;