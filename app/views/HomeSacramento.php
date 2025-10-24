<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacramentos - Paróquia Santuário São Judas Tadeu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <link rel="stylesheet" href="public/assets/css/HomeSacramento.css">
</head>
<body>

    <?php include 'NavBar.php'; // Incluindo a barra de navegação ?>

    <main>
        <div class="sacramento-header animate-on-scroll">
            <h1>Sacramentos</h1>
            <p>Os sacramentos são sinais sagrados através dos quais, por uma certa imitação dos sacramentos, são significados e, por impetração da Igreja, obtidos efeitos sobretudo espirituais.</p>
</div>

        <section class="sacramento-container">
            <?php if (!empty($sacramentos)): ?>
                <div class="sacramento-grid">
                    <?php foreach ($sacramentos as $sacramento): ?>
                        <div class="card sacramento-card animate-on-scroll">
                            <div class="card-body">
                                <h3><?= htmlspecialchars($sacramento['nome']) ?></h3>
                                
                                <?php if (!empty($sacramento['valor']) && $sacramento['valor'] > 0): ?>
                                    <p class="info-valor">
                                        Taxa: R$ <?= htmlspecialchars(number_format($sacramento['valor'], 2, ',', '.')) ?>
                                    </p>
                                <?php else: ?>
                                     <p class="info-valor">Sem taxa</p>
                                <?php endif; ?>
                                
                                <?php if (!empty($sacramento['descricao'])): ?>
                                    <div class="info-documentos">
                                        <strong>Documentos Necessários:</strong>
                                        <p><?= nl2br(htmlspecialchars($sacramento['descricao'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center;">Nenhuma informação sobre sacramentos disponível no momento.</p>
            <?php endif; ?>
        </section>
    </main>

    <script src="public/assets/js/animations.js"></script>
    <script src="public/assets/js/navbar.js"></script> </body>

</body>
</html>