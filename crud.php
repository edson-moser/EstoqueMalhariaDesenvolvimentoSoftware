<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilka Reblin · Cadastro de Produto</title>
   <link rel="stylesheet" href="crud.css" />
</head>
<body>

        <!-- Card de cadastro -->
        <div class="form-card">
            <div class="form-title">
                
                <h2>Cadastrar/Editar Produto</h2>
            </div>

            <form>
                <!-- SEÇÃO DE IMAGEM -->
                <div class="form-section">
                    <div class="section-title">
                        
                        <h3>Imagem do Produto</h3>
                    </div>
                    <div class="image-upload-area">
                        <div class="image-preview">
                            <div class="preview-placeholder">
                               
                                <span>Pré-visualização</span>
                            </div>
                        </div>
                        <div class="upload-controls">
                            <button type="button" class="btn-select-image">
                               
                                Selecionar Imagem
                            </button>
                            
                        </div>
                    </div>
                </div>

                <!-- SEÇÃO DE INFORMAÇÕES BÁSICAS -->
                <div class="form-section">
                    <div class="section-title">
                        
                        <h3>Informações Básicas</h3>
                    </div>
                    <div class="form-grid">
                        <!-- Nome do Produto -->
                        <div class="form-group full-width">
                            <label>
                                
                                Nome do Produto <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input" 
                                   placeholder="Ex: Camiseta Básica, Moletom, Calça..." required>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group full-width">
                            <label>
                                
                                Descrição
                            </label>
                            <textarea class="form-textarea" 
                                      placeholder="Ex: Algodão 100%, várias cores, tam. P ao GG" 
                                      rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <!-- SEÇÃO DE ESTOQUE -->
                <div class="form-section">
                    <div class="section-title">
                        
                        <h3>Controle de Estoque</h3>
                    </div>
                    <div class="form-grid">
                        <!-- Quantidade -->
                        <div class="form-group">
                            <label>
                                
                                Quantidade <span class="required">*</span>
                            </label>
                            <input type="number" class="form-input" 
                                   placeholder="Ex: 45" min="0" step="1" required>
                        </div>

                        <!-- Quantidade Mínima -->
                        <div class="form-group">
                            <label>
                                
                                Quantidade Mínima <span class="required">*</span>
                            </label>
                            <input type="number" class="form-input" 
                                   placeholder="Ex: 10" min="0" step="1" required>
                            <small class="field-hint">Quando o estoque atingir este valor, um aviso será gerado</small>
                        </div>

                        <!-- Observação -->
                        <div class="form-group full-width">
                            <label>
                                
                                Observação
                            </label>
                            <input type="text" class="form-input" 
                                   placeholder="Ex: Nova coleção, em promoção, aguardando reposição...">
                        </div>
                    </div>
                </div>

                <!-- BOTÕES -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel">
                        
                        Cancelar
                    </button>
                    <button type="submit" class="btn-save">
                        
                        Salvar Produto
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>