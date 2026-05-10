

<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verificar se o email já existe
    $stmt = $conn->prepare("SELECT id FROM clientes WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die("Email já cadastrado!");
    }

    // Inserir novo usuário
    $stmt = $conn->prepare("INSERT INTO clientes (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha]);

    // Obter o ID do usuário recém-criado
    $id = $conn->lastInsertId();

    $_SESSION['usuario'] = [
        'id' => $id,
        'nome' => $nome,
        'email' => $email
    ];

    $_SESSION['logado'] = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro realizado</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
        }

        .success {
            color: green;
            font-size: 20px;
            margin-bottom: 15px;
        }

        p {
            margin: 5px 0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }

        button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

<div class="card">
    <div class="success">✅ Cadastro realizado com sucesso!</div>

    <p><b>Nome:</b> <?php echo $_SESSION['usuario']['nome']; ?></p>
    <p><b>Email:</b> <?php echo $_SESSION['usuario']['email']; ?></p>

    <a href="painel.php">
        <button>Ir para o painel</button>
    </a>
</div>

</body>
</html>