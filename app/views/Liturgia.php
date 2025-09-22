<?php
 if (isset($liturgia['error'])): ?>
    <p style="color:red;"><?= htmlspecialchars($liturgia['error']) ?></p>
<?php elseif (isset($liturgia['primeiraLeitura'])): ?>
    <h2>Primeira leitura: <?= htmlspecialchars($liturgia['primeiraLeitura']['referencia']) ?></h2>
    <p><?= htmlspecialchars($liturgia['primeiraLeitura']['titulo']) ?></p>
    <p><?= nl2br(htmlspecialchars($liturgia['primeiraLeitura']['texto'])) ?></p>
<?php else: ?>
    <p>Nenhum dado disponível no momento.</p>
<?php endif; ?>
