<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malharia System · Avisos de Estoque</title>
    <link rel="stylesheet" href="TelaAvisos.css" />
    
</head>
<body>
    <div class="app-wrapper">
        <!-- SIDEBAR (MESMA DA TELA DE ESTOQUE) -->
        <div class="sidebar">
            <div class="logo-area">
                <h1>Malharia<br><span>SYSTEM</span></h1>
            </div>
            <div class="menu-side">
                <div class="menu-item-side"><a href="TelaEstoque.php">Estoque</a></div>
                <div class="menu-item-side active"><a href="TelaAvisos.php">Avisos</a></div>
                <div class="menu-item-side"><a href=""> Histórico</a></div>
                <div class="menu-item-side">Sair</div>
            </div>
        </div>

        <!-- CONTEÚDO PRINCIPAL - TELA DE AVISOS DE ESTOQUE -->
        <div class="main-content">
            <div class="content-header">
                <h2>Avisos de Estoque</h2>
               
            </div>

            <!-- Estatísticas rápidas -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon">⚠️</div>
                    <div class="stat-info">
                        <h4>Avisos ativos</h4>
                        <p>3 <span>estoque baixo</span></p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <div class="stat-info">
                        <h4>Produtos críticos</h4>
                        <p>2 <span>abaixo do mínimo</span></p>
                    </div>
                </div>
            </div>

            <!-- Título da seção -->
            <div class="avisos-title">
                <h3>🔔 PRODUTOS COM ESTOQUE BAIXO <span>3 avisos</span></h3>
            </div>

            <!-- Grid de avisos gerados automaticamente -->
            <div class="avisos-grid">
                <!-- AVISO 1: Calça Jogger (estoque 8 - gerado automaticamente) -->
                <div class="aviso-card">
                    <div class="aviso-icon">⚠️</div>
                    
                    <div class="aviso-info">
                        <div class="produto-nome">
                            Calça Jogger
                            <span>cód: 12345</span>
                            <span class="urgencia-badge">urgente</span>
                        </div>
                        
                        <div class="produto-descricao">
                            Calça jogger em moletom, ideal para o dia a dia
                        </div>
                        
                        <div class="produto-quantidade">
                            <div class="qty-badge">8 unidades</div>
                            <div class="estoque-minimo">Estoque mínimo: 15 unidades</div>
                        </div>
                    </div>
                    
                    <div class="aviso-data">
                        Gerado em 18/03/2026
                    </div>
                </div>

                <!-- AVISO 2: Camiseta Básica (estoque 12) -->
                <div class="aviso-card">
                    <div class="aviso-icon">⚠️</div>
                    
                    <div class="aviso-info">
                        <div class="produto-nome">
                            Camiseta Básica
                            <span>cód: 12346</span>
                        </div>
                        
                        <div class="produto-descricao">
                            Camiseta de algodão 100%, disponível em várias cores
                        </div>
                        
                        <div class="produto-quantidade">
                            <div class="qty-badge">12 unidades</div>
                            <div class="estoque-minimo">Estoque mínimo: 20 unidades</div>
                        </div>
                    </div>
                    
                    <div class="aviso-data">
                        Gerado em 18/03/2026
                    </div>
                </div>

                <!-- AVISO 3: Moletom com Capuz (estoque 5 - crítico) -->
                <div class="aviso-card" style="border-left-color: #b91c1c; background: #fef2f2;">
                    <div class="aviso-icon" style="background: #fecaca;">🔴</div>
                    
                    <div class="aviso-info">
                        <div class="produto-nome">
                            Moletom com Capuz
                            <span>cód: 12347</span>
                            <span class="urgencia-badge" style="background: #b91c1c;">crítico</span>
                        </div>
                        
                        <div class="produto-descricao">
                            Moletom confortável com capuz e bolso canguru
                        </div>
                        
                        <div class="produto-quantidade">
                            <div class="qty-badge" style="background: #fecaca; color: #b91c1c;">5 unidades</div>
                            <div class="estoque-minimo">Estoque mínimo: 20 unidades</div>
                        </div>
                    </div>
                    
                    <div class="aviso-data">
                        Gerado em 18/03/2026
                    </div>
                </div>

                <!-- AVISO 4: Jaqueta Jeans (estoque 10) -->
                <div class="aviso-card">
                    <div class="aviso-icon">⚠️</div>
                    
                    <div class="aviso-info">
                        <div class="produto-nome">
                            Jaqueta Jeans
                            <span>cód: 12348</span>
                        </div>
                        
                        <div class="produto-descricao">
                            Jaqueta jeans clássica, lavagem clara e escura
                        </div>
                        
                        <div class="produto-quantidade">
                            <div class="qty-badge">10 unidades</div>
                            <div class="estoque-minimo">Estoque mínimo: 15 unidades</div>
                        </div>
                    </div>
                    
                    <div class="aviso-data">
                        Gerado em 17/03/2026
                    </div>
                </div>
            </div>

            <!-- Instrução visual sobre como os avisos são gerados -->
            <div style="margin-top: 30px; padding: 20px; background: #f0f9ff; border-radius: 20px; border: 1px solid #bae6fd; display: flex; align-items: center; gap: 15px;">
                <strong style="background: #0284c7; color: white; padding: 4px 12px; border-radius: 40px;">ℹ️ SOBRE OS AVISOS</strong>
                <span style="color: #0369a1;">Os avisos são gerados automaticamente pelo sistema quando um produto atinge quantidade abaixo do estoque mínimo definido. Mostra apenas o produto, descrição e quantidade atual.</span>
            </div>

            <!-- Exemplo de quando não há avisos (opcional - comentado) -->
            <!-- 
            <div class="sem-avisos">
                <span>✅</span>
                <h4>Nenhum aviso no momento</h4>
                <p>Todos os produtos estão com estoque adequado.</p>
            </div>
            -->
        </div>
    </div>

    <!-- Script para o campo de pesquisa -->
    <script>
        const searchField = document.querySelector('.search-container input');
        if (searchField) {
            searchField.addEventListener('focus', function() {
                if (this.value === 'Filtrar avisos...') this.value = '';
            });
            searchField.addEventListener('blur', function() {
                if (this.value.trim() === '') this.value = 'Filtrar avisos...';
            });
        }

        // Simulação de como os avisos seriam gerados automaticamente
        console.log('Avisos gerados automaticamente com base no estoque:');
        console.log('- Calça Jogger: 8 unidades (mínimo 15)');
        console.log('- Camiseta Básica: 12 unidades (mínimo 20)');
        console.log('- Moletom com Capuz: 5 unidades (mínimo 20)');
        console.log('- Jaqueta Jeans: 10 unidades (mínimo 15)');
    </script>
</body>
</html>