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

                <img src="LOGO-ILKA-REBLIN-TRANSPARENTE.png" alt="Ilka Reblin Logo">

            </div>
            <div class="menu-side">
                <div class="menu-item-side"><a href="TelaEstoque.php">Estoque</a></div>
                <div class="menu-item-side"><a href="TelaAvisos.php">Avisos</a></div>
                <div class="menu-item-side"><a href="">Histórico</a></div>
                <div class="menu-item-side"><a href="logout.php">Sair</a></div>
            </div>
        </div>

        <!-- CONTEÚDO PRINCIPAL - TELA DE AVISOS DE ESTOQUE -->
        <div class="main-content">


            <!-- Título da seção -->
            <div class="avisos-title">
                <h3>PRODUTOS COM ESTOQUE BAIXO <span>2 avisos</span></h3>
            </div>

            <!-- Grid de avisos gerados automaticamente -->
            <div class="avisos-grid">
                <!-- AVISO 1: Calça Jogger (estoque 8 - gerado automaticamente) -->
                <div class="aviso-card">
                    <div class="aviso-icon"></div>

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


                <!-- AVISO 3: Moletom com Capuz (estoque 5 - crítico) -->
                <div class="aviso-card" style="border-left-color: #b91c1c; background: #fef2f2;">
                    <div class="aviso-icon" style="background: #fecaca;"></div>

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


            </div>
        </div>


        <script>
            const searchField = document.querySelector('.search-container input');
            if (searchField) {
                searchField.addEventListener('focus', function () {
                    if (this.value === 'Filtrar avisos...') this.value = '';
                });
                searchField.addEventListener('blur', function () {
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