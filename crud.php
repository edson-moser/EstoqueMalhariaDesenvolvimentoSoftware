<?php
session_start();
include("conexao.php");

if(!isset($_SESSION['malharia_id'])){
    header("Location: login.php");
    exit;
}
$malharia_id = $_SESSION['malharia_id'];

if(isset($_POST['salvar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome_produto'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $quantidade_minima = $_POST['quantidade_minima'];
    $observacoes = $_POST['observacoes'];

    if($id == ""){
       
        $sql = "INSERT INTO estoque 
        (nome_produto, descricao, quantidade, quantidade_minima, observacoes, malharia_id)
        VALUES 
        ('$nome', '$descricao', '$quantidade', '$quantidade_minima', '$observacoes', '$malharia_id')";
    } else {
        
        $sql = "UPDATE estoque SET
            nome_produto='$nome',
            descricao='$descricao',
            quantidade='$quantidade',
            quantidade_minima='$quantidade_minima',
            observacoes='$observacoes'
            WHERE id=$id AND malharia_id=$malharia_id";
    }

    $conecta->query($sql);
    header("Location: TelaEstoque.php");
}


$id = "";
$nome = "";
$descricao = "";
$quantidade = "";
$quantidade_minima = "";
$observacoes = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $result = $conecta->query("SELECT * FROM estoque WHERE id=$id AND malharia_id=$malharia_id");
    $row = $result->fetch_assoc();

    if($row){
        $nome = $row['nome_produto'];
        $descricao = $row['descricao'];
        $quantidade = $row['quantidade'];
        $quantidade_minima = $row['quantidade_minima'];
        $observacoes = $row['observacoes'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="crud.css">
</head>
<body>

<div class="cadastro-container">


    <div class="cadastro-header">
        <h1>Cadastro/Edição de Produto</h1>
        
    </div>

   
    <div class="form-card">

        <div class="form-title">
            
            <h2>Dados do Produto</h2>
        </div>

        <form method="POST">

            <input type="hidden" name="id" value="<?= $id ?>">

      
            <div class="form-grid">

                <div class="form-group">
                    <label>Nome <span class="required">*</span></label>
                    <input class="form-input" type="text" name="nome_produto" value="<?= $nome ?>" required>
                </div>

                <div class="form-group">
                    <label>Quantidade Atual <span class="required">*</span></label>
                    <input class="form-input" type="number" name="quantidade" value="<?= $quantidade ?>" required>
                </div>

                <div class="form-group">
                    <label>Quantidade mínima</label>
                    <input class="form-input" type="number" name="quantidade_minima" value="<?= $quantidade_minima ?>">
                </div>

                <div class="form-group full-width">
                    <label>Descrição</label>
                    <textarea class="form-textarea" name="descricao"><?= $descricao ?></textarea>
                </div>

                <div class="form-group full-width">
                    <label>Observações</label>
                    <textarea class="form-textarea" name="observacoes"><?= $observacoes ?></textarea>
                </div>

            </div>

            <!-- BOTÕES -->
            <div class="form-actions">
                <a href="TelaEstoque.php">
                    <button type="button" class="btn-cancel">Cancelar</button>
                </a>

                <button type="submit" name="salvar" class="btn-save">
                     Salvar Produto
                </button>
            </div>

        </form>

    </div>
</div>

</body>
</html>