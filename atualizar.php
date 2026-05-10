
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || !isset($_SESSION['usuario']['id'])) {
    die("Erro: faça login novamente.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION['usuario']['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($nome) || empty($email)) {
        die("Preencha todos os campos!");
    }

    if (!empty($senha)) {

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE clientes SET nome=?, email=?, senha=? WHERE id=?");
        $stmt->execute([$nome, $email, $senhaHash, $id]);

    } else {

        $stmt = $conn->prepare("UPDATE clientes SET nome=?, email=? WHERE id=?");
        $stmt->execute([$nome, $email, $id]);
    }

    if ($stmt->rowCount() > 0) {

        $_SESSION['usuario']['nome'] = $nome;
        $_SESSION['usuario']['email'] = $email;

        echo "<h2 style='color:green;text-align:center;margin-top:50px;'>✅ Dados atualizados!</h2>";
        echo "<div style='text-align:center;'><a href='painel.php'><button>Voltar</button></a></div>";

    } else {
        echo "Erro ao atualizar.";
    }
}
?>