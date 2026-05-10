<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>🧺 Lavanderia Express</h1>

    <h2>Login</h2>

    <form action="validar_login.php" method="POST">

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="senha" placeholder="Senha" required>

        <button type="submit">
            Entrar
        </button>

    </form>

    <p>Não tem conta?</p>

    <a href="cadastro.php">
        <button>
            Cadastrar
        </button>
    </a>

</div>

</body>
</html>