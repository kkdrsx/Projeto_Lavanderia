<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Dados</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h2>✏️ Editar Dados</h2>

    <form action="atualizar.php" method="POST">

        <input
            type="text"
            name="nome"
            value="<?php echo $_SESSION['usuario']['nome']; ?>"
            required
        >

        <input
            type="email"
            name="email"
            value="<?php echo $_SESSION['usuario']['email']; ?>"
            required
        >

        <input
            type="password"
            name="senha"
            placeholder="Nova senha"
        >

        <button type="submit">
            Atualizar
        </button>

    </form>

</div>

</body>
</html>