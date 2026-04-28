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

    $nome_imagem = "";


    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0){

        $arquivo = $_FILES['imagem'];
        $nome_imagem = time() . "_" . $arquivo['name'];

        move_uploaded_file($arquivo['tmp_name'], "imagens/" . $nome_imagem);
    }

    if($id == ""){
        $sql = "INSERT INTO estoque 
        (nome_produto, descricao, quantidade, quantidade_minima, observacoes, nome_imagem, malharia_id)
        VALUES 
        ('$nome', '$descricao', '$quantidade', '$quantidade_minima', '$observacoes', '$nome_imagem', '$malharia_id')";
    } else {

        if($nome_imagem != ""){

        $sql = "UPDATE estoque SET
                nome_produto='$nome',
                descricao='$descricao',
                quantidade='$quantidade',
                quantidade_minima='$quantidade_minima',
                observacoes='$observacoes',
                nome_imagem='$nome_imagem'
                WHERE id=$id AND malharia_id=$malharia_id";
        } else {
            
            $sql = "UPDATE estoque SET
                nome_produto='$nome',
                descricao='$descricao',
                quantidade='$quantidade',
                quantidade_minima='$quantidade_minima',
                observacoes='$observacoes'
                WHERE id=$id AND malharia_id=$malharia_id";
        }
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
$imagem_atual = "";

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
        $imagem_atual = $row['nome_imagem'];
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
        <h1>Cadastro de Produto</h1>
        <p>Gerencie os itens do seu estoque</p>
    </div>

    
    <div class="form-card">

        <div class="form-title">
            
            <h2>Produto</h2>
        </div>

        <form method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $id ?>">

            
            <div class="form-grid">

                <div class="form-group">
                    <label>Nome <span class="required">*</span></label>
                    <input class="form-input" type="text" name="nome_produto" value="<?= $nome ?>" required>
                </div>

                <div class="form-group">
                    <label>Quantidade <span class="required">*</span></label>
                    <input class="form-input" type="number" name="quantidade" value="<?= $quantidade ?>" required>
                </div>

                <div class="form-group">
                    <label>Quantidade mínima</label>
                    <input class="form-input" type="number" name="quantidade_minima" value="<?= $quantidade_minima ?>">
                </div>

                
                <div class="form-group full-width">
                    <label>Imagem do Produto</label>

                    <div class="image-upload-area">

                        <div class="image-preview">
                            <?php if($imagem_atual){ ?>
                                <img src="imagens/<?= $imagem_atual ?>" width="100%">
                            <?php } else { ?>
                                <div class="preview-placeholder">
                                    <span>Sem imagem</span>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="upload-controls">
                            <input type="file" name="imagem" class="form-input">

                        </div>

                    </div>
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

           
            <div class="form-actions">

                <a href="TelaEstoque.php">
                    <button type="button" class="btn-cancel">Cancelar</button>
                </a>

                <button type="submit" name="salvar" class="btn-save">
                Salvar
                </button>

            </div>

        </form>

    </div>
</div>

</body>
</html>