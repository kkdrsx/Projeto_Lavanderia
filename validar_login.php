<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM clientes WHERE email = ?");
    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        if (password_verify($senha, $usuario['senha'])) {

            $_SESSION['usuario'] = [
                'id' => $usuario['id'], // 🔥 ESSENCIAL
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ];

            $_SESSION['logado'] = true;

            header("Location: painel.php");
            exit;

        } else {
            echo "Senha incorreta!";
        }

    } else {
        echo "Usuário não encontrado!";
    }
}
?>