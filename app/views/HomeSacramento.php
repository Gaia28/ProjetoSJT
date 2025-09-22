<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacramentos</title>
</head>
<body>
        <div class="cards">
           <?php foreach ($sacramentos as $sacramento): ?>
  <div class="card">
    <img src="public/assets/images/lixeira.png" alt="Excluir" 
         class="botaoExcluir" 
         data-id="<?= $sacramento['id'] ?>" 
         data-entity="sacramento">

    <h3 class="titulo"><?= htmlspecialchars($sacramento['nome']) ?></h3>
    <p class="valor">Valor: R$ <?= number_format($sacramento['valor'], 2, ',', '.') ?></p>
    <p class="descricao"><?= htmlspecialchars($sacramento['descricao']) ?></p>

    <!-- botão editar COM dados para preencher o modal -->
    <button class="botaoEditar"
        data-id="<?= $sacramento['id'] ?>"
        data-nome="<?= htmlspecialchars($sacramento['nome']) ?>"
        data-tipo="<?= htmlspecialchars($sacramento['tipo'] ?? '') ?>"
        data-valor="<?= $sacramento['valor'] ?>"
        data-documentos="<?= htmlspecialchars($sacramento['documentos'] ?? $sacramento['descricao'] ?? '') ?>"
        data-entity="sacramento">
      Editar
    </button>
  </div>
<?php endforeach; ?>

</body>
</html>