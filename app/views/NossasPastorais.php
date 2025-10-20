<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nossas Pastorais - Paróquia Santuário São Judas Tadeu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <link rel="stylesheet" href="public/assets/css/Footer.css">
    <link rel="stylesheet" href="public/assets/css/Home.css">
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

    <?php include 'NavBar.php'; ?>

    <main>
        <header class="pastorais-header animate-on-scroll">
            <h1>Nossas Pastorais e Movimentos</h1>
            <p>
                As pastorais e movimentos são o coração da nossa comunidade, organizando os fiéis para aprofundar a fé, servir ao próximo e celebrar a vida em Cristo. Encontre um grupo para chamar de seu.
            </p>
        </header>

        <section class="pastorais-container">
            <?php if (!empty($pastorais)): ?>
                <div class="pastorais-grid">
                    <?php foreach ($pastorais as $pastoral): ?>
                        <div class="card pastoral-card animate-on-scroll">
                            <div class="card-body">
                                <h3><?= htmlspecialchars($pastoral['nome']) ?></h3>
                                
                                <?php if (!empty($pastoral['coordenadores'])): ?>
                                    <div class="info-item">
                                        <strong>Coordenação:</strong>
                                        
                                        <?php
                                        // Quebra a string em um array de coordenadores (separados por ';')
                                        $listaCoordenadores = explode(';', $pastoral['coordenadores']);
                                        foreach ($listaCoordenadores as $coord) {
                                            // Quebra cada coordenador em nome e telefone (separados por '|')
                                            $info = explode('|', $coord);
                                            $nome = $info[0] ?? '';
                                            $telefone = $info[1] ?? '';
                                            
                                            // Exibe nome e, se houver, o telefone abaixo
                                            echo "<p style='margin-bottom: 0.75rem;'>";
                                            echo htmlspecialchars($nome);
                                            if (!empty($telefone)) {
                                                echo "<br><span style='font-size: 0.9em; color: var(--cor-texto-suave);'>Tel: " . htmlspecialchars($telefone) . "</span>";
                                            }
                                            echo "</p>";
                                        }
                                        ?>
                                    </div>
                                <?php else: ?>
                                     <div class="info-item">
                                        <strong>Coordenação:</strong>
                                        <p>Informações não disponíveis.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center;">Nenhuma informação sobre pastorais disponível no momento.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'Footer.php'; ?>

    <script src="public/assets/js/animations.js"></script>
    <script src="public/assets/js/navbar.js"></script>
    <script src="public/assets/js/navegacao.js"></script>

</body>
</html>