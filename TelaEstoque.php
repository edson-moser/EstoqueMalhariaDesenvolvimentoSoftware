<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['malharia_id'])) {
    header("Location: login.php");
    exit;
}
$malharia_id = $_SESSION['malharia_id'];

if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $conecta->query("DELETE FROM estoque WHERE id=$id AND malharia_id=$malharia_id");
    header("Location: TelaEstoque.php");
}


$busca = isset($_GET['busca']) ? $_GET['busca'] : "";

$sql = "SELECT * FROM estoque 
        WHERE malharia_id=$malharia_id";

if ($busca != "") {
    $sql .= " AND (nome_produto LIKE '%$busca%' OR descricao LIKE '%$busca%')";
}

$result = $conecta->query($sql);


if (isset($_GET['ajax'])) {
    while ($row = $result->fetch_assoc()) {

        $baixo = ($row['quantidade'] <= $row['quantidade_minima']) ? true : false;

        echo "<div class='template-card' " . ($baixo ? "style='border:2px solid red;'" : "") . ">";

        echo "<div class='template-info'>";

        echo "<div class='template-field'>
                <div class='field-label'>Nome</div>
                <div class='field-placeholder'>{$row['nome_produto']}</div>
              </div>";

        echo "<div class='template-field'>
                <div class='field-label'>Descrição</div>
                <div class='field-placeholder'>{$row['descricao']}</div>
              </div>";

        echo "<div class='row-fields'>
                <div class='template-field'>
                    <div class='field-label'>Quantidade</div>
                    <div class='field-placeholder'>{$row['quantidade']}</div>
                </div>

                <div class='template-field'>
                    <div class='field-label'>Mínimo</div>
                    <div class='field-placeholder'>{$row['quantidade_minima']}</div>
                </div>
              </div>";

        if ($baixo) {
            echo "<div style='color:red; font-weight:bold;'>⚠ Estoque baixo!</div>";
        }

        echo "</div>";

        echo "<div class='template-actions'>
                <a href='crud.php?id={$row['id']}'>
                    <button class='btn-action edit'>Editar</button>
                </a>

                <a href='TelaEstoque.php?excluir={$row['id']}'>
                    <button class='btn-action delete'>Excluir</button>
                </a>
              </div>";

        echo "</div>";
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Estoque</title>
    <link rel="stylesheet" href="TelaEstoque.css">
</head>

<body>
    <div class="app-wrapper">

        <div class="sidebar">
            <div class="logo-area">

                <img src="LOGO-ILKA-REBLIN-TRANSPARENTE.png" alt="Ilka Reblin Logo">

            </div>
            <div class="menu-side">
                <div class="menu-item-side"><a href="TelaEstoque.php">Estoque</a></div>
                <div class="menu-item-side"><a href="TelaAvisos.php">Avisos</a></div>
                <div class="menu-item-side"><a href=""> Histórico</a></div>
                <div class="menu-item-side">Sair</div>
            </div>
        </div>
        <div class="app-wrapper">



            <div class="main-content">

                <div class="content-header">
                    <h2>Estoque</h2>

                    <div class="search-section">


                        <div class="search-container">
                            <span>🔍</span>
                            <input type="text" id="busca" placeholder="Pesquisar produto..." onkeyup="buscarProduto()">
                        </div>

                        <a href="crud.php">
                            <button class="btn-add">+ Novo Produto</button>
                        </a>

                    </div>
                </div>

                <div class="templates-grid" id="listaProdutos">

                    <?php while ($row = $result->fetch_assoc()) {
                        $baixo = ($row['quantidade'] <= $row['quantidade_minima']);
                        ?>

                        <div class="template-card" <?= $baixo ? "style='border:2px solid red;'" : "" ?>>

                            <div class="template-info">
                                <div class="product-image">
                                    <?php if ($row['nome_imagem']) { ?>
                                        <img src="imagens/<?= $row['nome_imagem'] ?>" width="100%">
                                    <?php } else { ?>
                                        <span>Sem imagem</span>
                                    <?php } ?>
                                </div>

                                <div class="template-field">
                                    <div class="field-label">Nome</div>
                                    <div class="field-placeholder"><?= $row['nome_produto'] ?></div>
                                </div>

                                <div class="template-field">
                                    <div class="field-label">Descrição</div>
                                    <div class="field-placeholder"><?= $row['descricao'] ?></div>
                                </div>

                                <div class="row-fields">
                                    <div class="template-field">
                                        <div class="field-label">Quantidade Atual</div>
                                        <div class="field-placeholder"><?= $row['quantidade'] ?></div>
                                    </div>

                                    <div class="template-field">
                                        <div class="field-label">Mínimo</div>
                                        <div class="field-placeholder"><?= $row['quantidade_minima'] ?></div>
                                    </div>
                                </div>

                                <?php if ($baixo) { ?>
                                    <div style="color:red; font-weight:bold;">⚠ Estoque baixo!</div>
                                <?php } ?>

                            </div>

                            <div class="template-actions">
                                <a href="crud.php?id=<?= $row['id'] ?>">
                                    <button class="btn-action edit">Editar</button>
                                </a>

                                <a href="TelaEstoque.php?excluir=<?= $row['id'] ?>">
                                    <button class="btn-action delete">Excluir</button>
                                </a>
                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>
        </div>


        <script>
            function buscarProduto() {
                let busca = document.getElementById("busca").value;

                let xhr = new XMLHttpRequest();
                xhr.open("GET", "TelaEstoque.php?ajax=1&busca=" + busca, true);

                xhr.onload = function () {
                    if (xhr.status == 200) {
                        document.getElementById("listaProdutos").innerHTML = xhr.responseText;
                    }
                }

                xhr.send();
            }
        </script>

</body>

</html>