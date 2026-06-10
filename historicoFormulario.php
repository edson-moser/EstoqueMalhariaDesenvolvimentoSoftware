<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['malharia_id'])) {
    header("Location: login.php");
    exit;
}

$malharia_id = $_SESSION['malharia_id'];

$periodo = $_POST['periodo'] ?? '3';

if ($periodo === 'personalizado') {
    $data_inicio = $_POST['data_inicio'] ?? '';
    $data_fim = $_POST['data_fim'] ?? '';
    if (!$data_inicio || !$data_fim) {
        die("Selecione as datas para o período personalizado.");
    }
} else {
    $meses = intval($periodo);
    $data_fim = date('Y-m-d');
    $data_inicio = date('Y-m-d', strtotime("-$meses months"));
}

$sql_produtos = "SELECT * FROM estoque WHERE malharia_id = $malharia_id ORDER BY nome_produto ASC";
$result_produtos = $conecta->query($sql_produtos);

$sql = "SELECT m.*, e.nome_produto 
        FROM movimentacao_estoque m 
        JOIN estoque e ON m.estoque_id = e.id 
        WHERE m.malharia_id = $malharia_id 
        AND m.data_movimento BETWEEN '$data_inicio' AND '$data_fim' 
        ORDER BY m.data_movimento ASC";
$result = $conecta->query($sql);

$movimentacoes = [];
$entradas = [];
$saidas = [];

while ($row = $result->fetch_assoc()) {
    $produto = $row['nome_produto'];
    
    if ($row['tipo_movimento'] == 'entrada') {
        $entradas[$produto] = ($entradas[$produto] ?? 0) + $row['quantidade'];
    } else {
        $saidas[$produto] = ($saidas[$produto] ?? 0) + $row['quantidade'];
    }
    
    $movimentacoes[] = $row;
}

$sql_falta = "SELECT nome_produto, quantidade, quantidade_minima 
              FROM estoque 
              WHERE malharia_id = $malharia_id 
              AND quantidade <= quantidade_minima 
              ORDER BY quantidade ASC";
$result_falta = $conecta->query($sql_falta);
$itens_falta = [];
while ($row = $result_falta->fetch_assoc()) {
    $itens_falta[] = $row;
}

$sql_zerado = "SELECT nome_produto FROM estoque WHERE malharia_id = $malharia_id AND quantidade = 0";
$result_zerado = $conecta->query($sql_zerado);
$itens_zerados = [];
while ($row = $result_zerado->fetch_assoc()) {
    $itens_zerados[] = $row['nome_produto'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Relatório de Estoque</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 30px; background: #fff; color: #000; }
        h1 { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 10px; font-size: 20px; }
        .periodo { text-align: center; margin-bottom: 20px; font-size: 14px; }
        h2 { margin-top: 25px; border-left: 4px solid #000; padding-left: 10px; font-size: 16px; }
        h3 { margin-top: 15px; font-size: 14px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 13px; }
        th, td { padding: 6px 4px; border: 1px solid #000; text-align: left; }
        th { background: #ddd; font-weight: bold; }
        .total-linha { font-weight: bold; background: #eee; }
        .resumo { border: 1px solid #000; padding: 10px; margin: 15px 0; }
        .resumo p { margin: 3px 0; }
        .falta-item { border-left: 4px solid #c62828; padding: 8px 12px; margin: 5px 0; background: #f5f5f5; }
        .zerado-item { border-left: 4px solid #e65100; padding: 8px 12px; margin: 5px 0; background: #f5f5f5; }
        .footer { margin-top: 20px; text-align: center; border-top: 1px solid #000; padding-top: 10px; font-size: 11px; }
        .btn-print { display: block; margin: 0 auto 20px; padding: 10px 25px; background: #6A2C70; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 14px; }
        .btn-print:hover { background: #E86A92; }
        @media print { .btn-print { display: none; } }
        .positivo { color: #2e7d32; }
        .negativo { color: #c62828; }
        .zero { color: #666; }
    </style>
</head>
<body>

   

    <h1>RELATÓRIO DE MOVIMENTAÇÃO DE ESTOQUE</h1>
    <div class="periodo">Período: <?php echo date('d/m/Y', strtotime($data_inicio)); ?> a <?php echo date('d/m/Y', strtotime($data_fim)); ?></div>

   
    <?php if (!empty($saidas)): ?>
        <h2>PRODUTOS UTILIZADOS (SAÍDAS)</h2>
        <table>
            <thead><tr><th>Produto</th><th>Quantidade Utilizada</th></tr></thead>
            <tbody>
                <?php foreach ($saidas as $produto => $qtd): ?>
                    <tr><td><?php echo htmlspecialchars($produto); ?></td><td><?php echo $qtd; ?></td></tr>
                <?php endforeach; ?>
                <tr class="total-linha"><td>TOTAL DE SAÍDAS</td><td><?php echo array_sum($saidas); ?></td></tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum produto foi utilizado no período.</p>
    <?php endif; ?>

    
    <?php if (!empty($entradas)): ?>
        <h2>PRODUTOS QUE ENTRARAM NO ESTOQUE</h2>
        <table>
            <thead><tr><th>Produto</th><th>Quantidade que Entrou</th></tr></thead>
            <tbody>
                <?php foreach ($entradas as $produto => $qtd): ?>
                    <tr><td><?php echo htmlspecialchars($produto); ?></td><td><?php echo $qtd; ?></td></tr>
                <?php endforeach; ?>
                <tr class="total-linha"><td>TOTAL DE ENTRADAS</td><td><?php echo array_sum($entradas); ?></td></tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum produto entrou no estoque no período.</p>
    <?php endif; ?>

    
    <h2>SALDO INDIVIDUAL POR PRODUTO (ESTOQUE ATUAL)</h2>
    <table>
        <thead>
            <tr>
                <th>Produto</th>
                <th>Entradas no Período</th>
                <th>Saídas no Período</th>
                <th>Estoque Atual</th>
                <th>Mínimo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $sql_todos = "SELECT * FROM estoque WHERE malharia_id = $malharia_id ORDER BY nome_produto ASC";
            $result_todos = $conecta->query($sql_todos);
            
            while ($produto_row = $result_todos->fetch_assoc()):
                $produto = $produto_row['nome_produto'];
                $estoque_atual = $produto_row['quantidade'];
                $minimo = $produto_row['quantidade_minima'];
                
                
                $qtd_entrada = $entradas[$produto] ?? 0;
                $qtd_saida = $saidas[$produto] ?? 0;
                
                
                if ($estoque_atual <= 0) {
                    $status = 'Zerado ';
                    $cor_status = '#e65100';
                } elseif ($estoque_atual <= $minimo) {
                    $status = 'Baixo ';
                    $cor_status = '#c62828';
                } elseif ($estoque_atual <= $minimo * 1.5) {
                    $status = 'Atenção ';
                    $cor_status = '#e65100';
                } else {
                    $status = 'OK ';
                    $cor_status = '#2e7d32';
                }
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto); ?></td>
                    <td><?php echo $qtd_entrada; ?></td>
                    <td><?php echo $qtd_saida; ?></td>
                    <td style="font-weight:bold;"><?php echo $estoque_atual; ?></td>
                    <td><?php echo $minimo; ?></td>
                    <td style="color:<?php echo $cor_status; ?>; font-weight:bold;">
                        <?php echo $status; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Itens em Falta (abaixo da quantidade mínima) -->
    <?php if (!empty($itens_falta)): ?>
        <h2>ITENS EM FALTA (ABAIXO DO MÍNIMO)</h2>
        <?php foreach ($itens_falta as $item): ?>
            <div class="falta-item">
                <strong><?php echo htmlspecialchars($item['nome_produto']); ?></strong>
                - Estoque atual: <?php echo $item['quantidade']; ?> unidades
                (Mínimo necessário: <?php echo $item['quantidade_minima']; ?> unidades)
                <span style="color:#c62828; font-weight:bold;"></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum item está abaixo da quantidade mínima.</p>
    <?php endif; ?>

    <?php if (!empty($itens_zerados)): ?>
        <h2>ITENS COM ESTOQUE ZERADO</h2>
        <?php foreach ($itens_zerados as $produto): ?>
            <div class="zerado-item">
                <strong><?php echo htmlspecialchars($produto); ?></strong>
                - Estoque esgotado!
                <span style="color:#e65100; font-weight:bold;"></span>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


    <div class="resumo">
        <h2 style="border-left: none; padding-left: 0; margin-top: 0;">RESUMO DO PERÍODO</h2>
        <p><strong>Total de produtos utilizados no período:</strong> <?php echo array_sum($saidas); ?></p>
        <p><strong>Total de produtos que entraram no período:</strong> <?php echo array_sum($entradas); ?></p>
        <p><strong>Saldo total do período:</strong> <?php echo array_sum($entradas) - array_sum($saidas); ?></p>
        <p><strong>Produtos com estoque baixo:</strong> <?php echo count($itens_falta); ?></p>
        <p><strong>Produtos com estoque zerado:</strong> <?php echo count($itens_zerados); ?></p>
        <p><strong>Total de produtos no estoque:</strong> <?php echo $result_todos->num_rows; ?></p>
    </div>

     <button class="btn-print" onclick="window.print()"> Salvar como PDF</button>

</body>
</html>