<?php
session_start();
include("conexao.php");

if (!isset($_SESSION['malharia_id'])) {
    header("Location: login.php");
    exit;
}

$malharia_id = $_SESSION['malharia_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Estoque</title>
    <link rel="stylesheet" href="Historico.css">
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
            <div class="menu-item-side active"><a href="historico.php">Histórico</a></div>
            <div class="menu-item-side"><a href="logout.php">Sair</a></div>
        </div>
    </div>


    <div class="main-content">
        <div class="content-header">
            <h2>Histórico de Movimentações</h2>
        </div>

        <div class="form-card">
            <form method="POST" action="historicoFormulario.php" target="_blank">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Período</label>
                        <select name="periodo" class="form-input" required>
                            <option value="1">Último mês</option>
                            <option value="3" selected>Últimos 3 meses</option>
                            <option value="6">Últimos 6 meses</option>
                            <option value="12">Últimos 12 meses</option>
                            <option value="personalizado">Período personalizado</option>
                        </select>
                    </div>

                    <div class="form-group" id="campoDataInicio" style="display:none;">
                        <label>Data Início</label>
                        <input type="date" name="data_inicio" class="form-input">
                    </div>

                    <div class="form-group" id="campoDataFim" style="display:none;">
                        <label>Data Fim</label>
                        <input type="date" name="data_fim" class="form-input">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-save" style="width:100%;">
                            <i class="fas fa-file-pdf"></i> Gerar PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>


<script>
    document.querySelector('select[name="periodo"]').addEventListener('change', function() {
        if (this.value === 'personalizado') {
            document.getElementById('campoDataInicio').style.display = 'block';
            document.getElementById('campoDataFim').style.display = 'block';
        } else {
            document.getElementById('campoDataInicio').style.display = 'none';
            document.getElementById('campoDataFim').style.display = 'none';
        }
    });
</script>

</body>
</html>