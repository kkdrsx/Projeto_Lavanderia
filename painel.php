<?php
// ==========================
// Iniciar Sessão
// ==========================
session_start();

date_default_timezone_set('America/Sao_Paulo');


// ==========================
// Verifica o login
// ==========================
if (!isset($_SESSION['logado'])) {

    header("Location: index.php");
    exit;
}


// ==========================
// Cria o array de pedidos caso não exista
// ==========================
if (!isset($_SESSION['pedidos'])) {

    $_SESSION['pedidos'] = [];
}


// ==========================
// ADICIONAR PEDIDO
// ==========================
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['peso'])) {

        $dados = explode('|', $_POST['tipo']);

        $tipoRoupa = $dados[0];

        $preco = (float) $dados[1];

        $peso = (float) $_POST['peso'];

        $total = $peso * $preco;

    $_SESSION['pedidos'][] = [

        'tipo' => $tipoRoupa,
        'peso'  => $peso,
        'preco' => $preco,
        'total' => $total,

        // formato correto para salvar
        'data' => date("Y-m-d H:i:s"),

        'status' => 'Lavando'
    ];
}


// ==========================
// CALCULAR TOTAL GERAL
// ==========================
$totalGeral = 0;

foreach ($_SESSION['pedidos'] as $pedido) {

    $totalGeral += $pedido['total'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Painel</title>

    <link rel="stylesheet" href="style.css">

</head>

<body class="painel-body">

    <!-- ==========================
         HEADER
    =========================== -->

    <header class="painel-header">

        <h1>🧺 Lavanderia Express</h1>

    </header>


    <!-- ==========================
         CONTAINER PRINCIPAL
    =========================== -->

    <div class="painel-container">


        <!-- ==========================
             USUÁRIO
        =========================== -->

        <div class="painel-coluna">

            <h2>👤 Usuário</h2>

            <p>
                <strong>Nome:</strong>
                <?php echo $_SESSION['usuario']['nome']; ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?php echo $_SESSION['usuario']['email']; ?>
            </p>

            <br>

            <a href="editar.php">
                <button>
                    ✏️ Editar Dados
                </button>
            </a>

            <a href="logout.php">
                <button class="btn-sair">
                    🚪 Sair
                </button>
            </a>

        </div>


        <!-- ==========================
             PEDIDOS
        =========================== -->

        <div class="painel-coluna">

            <h2>🧺 Serviços</h2>


            <!-- TABELA DE PREÇOS -->

            <h3>📋 Preços</h3>

            <ul class="lista-precos">

                <li>Camisa — R$10/kg</li>

                <li>Terno — R$15/kg</li>

                <li>Cobertor — R$12/kg</li>

                <li>Calça Jeans — R$8/kg</li>

            </ul>

            <hr>
            <br>

            <!-- NOVO PEDIDO -->

            <h3>➕ Novo Pedido</h3>

            <form method="POST">

                <input
                    type="number"
                    step="0.1"
                    name="peso"
                    placeholder="Peso da roupa (kg)"
                    required
                >

                <select name="tipo" required>

                
                    <option value="Camisa|10">
                        Camisa - R$10/kg
                    </option>

                    <option value="Terno|15">
                        Terno - R$15/kg
                    </option>

                    <option value="Cobertor|12">
                        Cobertor - R$12/kg
                    </option>

                    <option value="Calça Jeans|8">
                        Calça Jeans - R$8/kg
                    </option>

                    </select>
                    
                </select>


                <select name="pagamento" required>

                    <option value="">
                        Forma de pagamento
                    </option>

                    <option value="Pix">
                        Pix
                    </option>

                    <option value="Débito">
                        Cartão de Débito
                    </option>

                    <option value="Crédito">
                        Cartão de Crédito
                    </option>

                    <option value="Dinheiro">
                        Dinheiro
                    </option>

                </select>


                <button type="submit">
                    Adicionar Pedido
                </button>

            </form>

            <br>


            <!-- LISTA DE PEDIDOS -->

            <h3>📦 Pedidos</h3>

            <?php if (empty($_SESSION['pedidos'])) : ?>

                <p>Nenhum pedido ainda.</p>

            <?php else : ?>

                <?php foreach ($_SESSION['pedidos'] as $index => $pedido) : ?>

                    <div class="pedido">
                        
                    <p>
                        👕 Tipo:
                        <?php echo $pedido['tipo']; ?>
                    </p>


                        <p>
                            🧺
                            <?php echo $pedido['peso']; ?> kg
                        </p>

                        <p>
                            💰
                            R$
                            <?php echo number_format($pedido['total'], 2, ',', '.'); ?>
                        </p>

                        <p>
                            📅
                            <?php
                            echo date(
                                "d/m/Y H:i",
                                strtotime($pedido['data'])
                            );
                            ?>
                        </p>

                        <p class="status">
                            Status:
                            <?php echo $pedido['status']; ?>
                        </p>

                        <a href="excluir_pedido.php?id=<?php echo $index; ?>">

                            <button class="btn-excluir">
                                Excluir
                            </button>

                        </a>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>


            <!-- TOTAL -->

            <div class="total-geral">

                💵 Total geral:
                <strong>
                    R$
                    <?php echo number_format($totalGeral, 2, ',', '.'); ?>
                </strong>

            </div>

        </div>

    </div>

</body>
</html>