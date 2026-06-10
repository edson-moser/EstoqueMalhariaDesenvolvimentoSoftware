<?php
include("conexao.php");
$malharia_id = 1;

$sql = "SELECT * FROM estoque 
        WHERE quantidade <= quantidade_minima 
        AND malharia_id = $malharia_id";

$result = $conecta->query($sql);
$totalAvisos = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Avisos de Estoque</title>
    <link rel="stylesheet" href="TelaAvisos.css">
</head>

<body>

    <div class="app-wrapper">
        <div class="sidebar">
            <div class="logo-area">
                <img src="LOGO-ILKA-REBLIN-TRANSPARENTE.png">
            </div>

            <div class="menu-side">
                <div class="menu-item-side"><a href="TelaEstoque.php">Estoque</a></div>
                <div class="menu-item-side active"><a href="TelaAvisos.php">Avisos</a></div>
                <div class="menu-item-side"><a href="historico.php">Histórico</a></div>
                <div class="menu-item-side"><a href="logout.php">Sair</a></div>
            </div>
        </div>

        <div class="main-content">

            <div class="avisos-title">
                <h3>PRODUTOS COM ESTOQUE BAIXO
                    <span><?php echo $totalAvisos; ?> avisos</span>
                </h3>
            </div>

            <div class="avisos-grid">

                <?php
                if ($totalAvisos > 0) {

                    while ($row = $result->fetch_assoc()) {

                        $nome = $row['nome_produto'];
                        $descricao = $row['descricao'];
                        $quantidade = $row['quantidade'];
                        $minimo = $row['quantidade_minima'];
                        $imagem = $row['nome_imagem'];
                        $id = $row['id'];

                        if ($quantidade <= ($minimo / 2)) {
                            $urgencia = "crítico";
                            $cor = "#b91c1c";
                            $bg = "#fef2f2";
                            $iconBg = "#fecaca";
                        } else {
                            $urgencia = "urgente";
                            $cor = "#E86A92";
                            $bg = "#FFFFFF";
                            $iconBg = "#F6A5C0";
                        }
                        ?>

                        <div class="aviso-card" style="border-left-color: <?php echo $cor; ?>; background: <?php echo $bg; ?>;">

                            <div class="aviso-icon">
                                <?php if (!empty($imagem)) { ?>
                                    <img src="imagens/<?php echo $imagem; ?>" alt="<?php echo $nome; ?>">
                                <?php } else { ?>
                                    
                                <?php } ?>
                            </div>

                            <div class="aviso-info">
                                <div class="produto-nome">
                                    <?php echo $nome; ?>
                                    <span>cód: <?php echo $id; ?></span>
                                    <span class="urgencia-badge" style="background: <?php echo $cor; ?>">
                                        <?php echo $urgencia; ?>
                                    </span>
                                </div>

                                <div class="produto-descricao">
                                    <?php echo $descricao; ?>
                                </div>

                                <div class="produto-quantidade">
                                    <div class="qty-badge">
                                        <?php echo $quantidade; ?> unidades
                                    </div>
                                    <div class="estoque-minimo">
                                        Estoque mínimo: <?php echo $minimo; ?> unidades
                                    </div>
                                </div>
                            </div>

                            <div class="aviso-data">
                                <?php echo date("d/m/Y", strtotime($row['data_atualizacao'])); ?>
                            </div>
                        </div>

                        <?php
                    }

                } else {
                    ?>

                    <div class="sem-avisos">
                        <span>✔</span>
                        <h4>Sem avisos</h4>
                        <p>Todos os produtos estão OK.</p>
                    </div>

                <?php } ?>

            </div>

        </div>
    </div>

</body>

</html>