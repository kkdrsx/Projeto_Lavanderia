
<?php
include 'conexao.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM clientes WHERE id=?");
$stmt->execute([$id]);

echo "❌ Dado excluído com sucesso!<br>";
echo "<a href='painel.php'>Voltar</a>";
?>