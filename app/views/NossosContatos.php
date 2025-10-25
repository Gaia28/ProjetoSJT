<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contatos - Paróquia Santuário São Judas Tadeu</title>
    
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/NavBar.css">
    <link rel="stylesheet" href="public/assets/css/Footer.css">
    <link rel="stylesheet" href="public/assets/css/NossosContatos.css"> <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include 'NavBar.php'; ?>

    <main>
        <header class="contatos-header animate-on-scroll">
            <h1>Fale Conosco</h1>
            <p>Precisa entrar em contato com a secretaria, agendar um atendimento ou falar com algum responsável? Encontre aqui as informações que você procura.</p>
        </header>

        <section class="contatos-container">
            <?php if (!empty($contatos)): ?>
                <div class="contatos-grid">
                    <?php foreach ($contatos as $contato): ?>
                        <div class="card contato-card animate-on-scroll">
                            <div class="card-body">
                                <h3><?= htmlspecialchars($contato['nome']) ?></h3>
                                <span class="funcao"><?= htmlspecialchars($contato['funcao']) ?></span>
                                
                                <div class="info-contato">
                                    <?php if (!empty($contato['telefone'])): ?>
                                        <p><strong><i class="fas fa-phone"></i></strong> <?= htmlspecialchars($contato['telefone']) ?></p>
                                    <?php endif; ?>
                                    <?php if (!empty($contato['email'])): ?>
                                        <p><strong><i class="fas fa-envelope"></i></strong> <a href="mailto:<?= htmlspecialchars($contato['email']) ?>"><?= htmlspecialchars($contato['email']) ?></a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p style="text-align: center;">Nenhuma informação de contato disponível no momento.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include 'Footer.php'; ?>

    <script src="public/assets/js/animations.js"></script>
    <script src="public/assets/js/navbar.js"></script>
    <script src="public/assets/js/navegacao.js"></script>
</body>
</html>