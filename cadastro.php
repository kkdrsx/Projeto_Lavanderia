<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>🧺 Lavanderia Express</h1>

    <h2>Cadastro</h2>

    <form action="salvar.php" method="POST">

        <input type="text" name="nome" placeholder="Nome" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit">
            Cadastrar
        </button>

    </form>

    <a href="index.php">
        <button>
            Voltar
        </button>
    </a>


</body>
</html>