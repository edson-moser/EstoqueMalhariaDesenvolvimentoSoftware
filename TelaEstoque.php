<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malharia System · Template de Produto</title>
    <link rel="stylesheet" href="TelaEstoque.css" />

</head>

<body>
    <div class="app-wrapper">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="logo-area">

                <img src="LOGO-ILKA-REBLIN-TRANSPARENTE.png" alt="Ilka Reblin Logo">

            </div>
            <div class="menu-side">
                <div class="menu-item-side"><a href="TelaEstoque.php">Estoque</a></div>
                <div class="menu-item-side"><a href="TelaAvisos.php">Avisos</a></div>
                <div class="menu-item-side"><a href="">Histórico</a></div>
                <div class="menu-item-side"><a href="logout.php">Sair</a></div>
                
            </div>
        </div>

        <!-- CONTEÚDO PRINCIPAL -->
        <div class="main-content">
            <div class="content-header">
                <h2>Controle de Estoque</h2>

                <div class="search-section">
                    <div class="search-container">
                        <span>🔍</span>
                        <input type="text" placeholder="Pesquisar produtos..." value="Pesquisar produtos...">
                    </div>
                    <button class="btn-add">
                        <span>+</span> Adicionar Novo Produto
                    </button>
                </div>
            </div>

            <!-- Área de produtos em estoque -->
            <div class="template-title">
                <h3>PRODUTOS EM ESTOQUE:</h3>
            </div>

            <div class="templates-grid">
                <!-- CARD MODELO (BASE) - com imagem, quantidade, descrição e observações -->
                <div class="template-card">
                    <!-- Imagem do produto -->
                    <div class="product-image">
                        <span>Imagem<br>do Produto</span>
                    </div>

                    <!-- Informações do template -->
                    <div class="template-info">
                        <!-- Campo NOME -->
                        <div class="template-field">
                            <div class="field-label">Nome do Produto</div>
                            <div class="field-placeholder">
                                <span>Ex: Camiseta Básica, Moletom, Calça...</span>
                            </div>
                        </div>

                        <!-- Campo DESCRIÇÃO -->
                        <div class="template-field">
                            <div class="field-label">Descrição</div>
                            <div class="field-placeholder">
                                <span>Ex: Algodão 100%, várias cores, tam. P ao GG</span>
                            </div>
                        </div>

                        <!-- Linha com QUANTIDADE e OBSERVAÇÕES lado a lado -->
                        <div class="row-fields">
                            <!-- Quantidade -->
                            <div class="template-field">
                                <div class="field-label">Quantidade</div>
                                <div class="field-placeholder">
                                    <span>Ex: 45 unidades</span>
                                </div>
                            </div>

                            <!-- Observações -->
                            <div class="template-field">
                                <div class="field-label">Observações</div>
                                <div class="field-placeholder">
                                    <span>Ex: Nova coleção, em promoção, aguardando reposição...</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações (editar/excluir) -->
                    <div class="template-actions">
                        <span class="btn-action edit">[Edit]</span>
                        <span class="btn-action delete">[Excluir]</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para o campo de pesquisa -->
    <script>
        const searchField = document.querySelector('.search-container input');
        if (searchField) {
            searchField.addEventListener('focus', function () {
                if (this.value === 'Pesquisar produtos...') this.value = '';
            });
            searchField.addEventListener('blur', function () {
                if (this.value.trim() === '') this.value = 'Pesquisar produtos...';
            });
        }
    </script>
</body>

</html>