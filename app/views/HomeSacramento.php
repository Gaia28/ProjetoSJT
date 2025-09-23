<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/assets/css/Home.css"> 
    <title>Sacramentos</title>
</head>
<body>
    <?php include 'NavBar.php'; ?>

    <section id="Sacramentos" class="section-padrao">
        <div class="linha">  
            <img class="icon" src="public/assets/images/calendario.png" alt="Ícone de sacramentos">      
            <h1>Nossos Sacramentos</h1>
            <p>Confira os sacramentos oferecidos pela nossa paróquia</p>

            <div class="cards">
                <?php if (!empty($sacramentos)): ?>
                    <?php foreach ($sacramentos as $sacramento): ?>
                        <div class="card">
                            <h3 class="titulo"><?= htmlspecialchars($sacramento['nome']) ?></h3>
                            <p class="valor">Valor: R$ <?= number_format($sacramento['valor'], 2, ',', '.') ?></p>
                            <p class="descricao"><?= htmlspecialchars($sacramento['descricao']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhum sacramento cadastrado no momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
