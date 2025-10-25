<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Contatos</title>
    
    <link rel="stylesheet" href="public/assets/css/base.css">
    <link rel="stylesheet" href="public/assets/css/PagesAdmin.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="circle"><img src="public/assets/images/logo.PNG" alt="Logo do Santuário"></div>
        <p>Paróquia Santuário São Judas Tadeu</p>
        <nav><a href="homeAdmin">Voltar ao Painel</a></nav>
    </header>

    <section class="container">
        
        <h1>Gerenciar Contatos</h1>
        <p>Adicione, edite ou remova os contatos importantes da paróquia.</p>

        <button class="botao" id="adicionarContatoBtn">Adicionar Novo Contato</button>

        <dialog id="modalAdicionarContato" class="modalEvento">
            <button class="fecharModal">X</button>
            <h2>Cadastrar Novo Contato</h2>
            <form action="salvar-contato" method="POST">
                <div class="form-group"><label for="add_nome">Nome:</label><input type="text" id="add_nome" name="nome" required></div>
                <div class="form-group"><label for="add_funcao">Função/Cargo:</label><input type="text" id="add_funcao" name="funcao" required></div>
                <div class="form-group"><label for="add_telefone">Telefone:</label><input type="text" id="add_telefone" name="telefone"></div>
                <div class="form-group"><label for="add_email">Email:</label><input type="email" id="add_email" name="email"></div>
                <button type="submit" class="botao">Salvar Contato</button>
            </form>
        </dialog>

        <dialog id="modalEditarContato" class="modalEvento">
            <button class="fecharModal">X</button>
            <h2>Editar Contato</h2>
            <form action="editar-contato" method="POST">
                <input type="hidden" id="edit_id" name="id">
                <div class="form-group"><label for="edit_nome">Nome:</label><input type="text" id="edit_nome" name="nome" required></div>
                <div class="form-group"><label for="edit_funcao">Função/Cargo:</label><input type="text" id="edit_funcao" name="funcao" required></div>
                <div class="form-group"><label for="edit_telefone">Telefone:</label><input type="text" id="edit_telefone" name="telefone"></div>
                <div class="form-group"><label for="edit_email">Email:</label><input type="email" id="edit_email" name="email"></div>
                <button type="submit" class="botao">Salvar Alterações</button>
            </form>
        </dialog>

        <div class="cards" id="cardsContatos">
            <?php if (!empty($contatos)): ?>
                <?php foreach ($contatos as $contato): ?>
                    <div class="card" data-contato-id="<?= $contato['id'] ?>">
                        <div class="card-body"> 
                            <h3><?= htmlspecialchars($contato['nome']) ?></h3>
                            <p><strong>Função:</strong> <?= htmlspecialchars($contato['funcao']) ?></p>
                            <?php if (!empty($contato['telefone'])): ?>
                                <p><strong>Telefone:</strong> <?= htmlspecialchars($contato['telefone']) ?></p>
                            <?php endif; ?>
                            <?php if (!empty($contato['email'])): ?>
                                <p><strong>Email:</strong> <?= htmlspecialchars($contato['email']) ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer">
                            <img src="public/assets/images/lixeira.png" alt="Excluir" class="botaoExcluir" data-id="<?= $contato['id'] ?>" data-entity="contato">
                            <button class="botaoEditar"
                                    data-id="<?= $contato['id'] ?>"
                                    data-entity="contato"
                                    data-nome="<?= htmlspecialchars($contato['nome']) ?>"
                                    data-funcao="<?= htmlspecialchars($contato['funcao']) ?>"
                                    data-telefone="<?= htmlspecialchars($contato['telefone']) ?>"
                                    data-email="<?= htmlspecialchars($contato['email']) ?>">
                                Editar
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align: center; margin-top: 2rem;">Nenhum contato cadastrado.</p>
            <?php endif; ?>
        </div>

    </section>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const safe = id => document.getElementById(id);
        const modalAdicionar = safe('modalAdicionarContato');
        const modalEditar = safe('modalEditarContato');
        const btnAdicionar = safe('adicionarContatoBtn');

        if (btnAdicionar && modalAdicionar) {
            btnAdicionar.addEventListener('click', () => modalAdicionar.showModal());
            modalAdicionar.querySelector('.fecharModal').addEventListener('click', () => modalAdicionar.close()); 
        }
        if (modalEditar) {
            modalEditar.querySelector('.fecharModal').addEventListener('click', () => modalEditar.close());
        }

        document.querySelectorAll(".botaoEditar[data-entity='contato']").forEach(btn => {
            btn.addEventListener("click", () => {
                safe('edit_id').value = btn.dataset.id || '';
                safe('edit_nome').value = btn.dataset.nome || '';
                safe('edit_funcao').value = btn.dataset.funcao || '';
                safe('edit_telefone').value = btn.dataset.telefone || '';
                safe('edit_email').value = btn.dataset.email || '';
                if (modalEditar) modalEditar.showModal();
            });
        });

        document.querySelectorAll(".botaoExcluir[data-entity='contato']").forEach(btn => {
            btn.addEventListener("click", () => {
                const id = btn.dataset.id;
                if (!confirm("Tem certeza que deseja excluir este contato?")) return;

                fetch('excluir-contato', {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + encodeURIComponent(id)
                })
                .then(r => r.json().catch(() => ({ success: false, message: "Resposta inválida" })))
                .then(data => {
                    if (data.success) {
                        const cardToRemove = document.querySelector(`.card[data-contato-id='${id}']`);
                        if (cardToRemove) {
                            cardToRemove.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            cardToRemove.style.opacity = '0';
                            cardToRemove.style.transform = 'scale(0.95)';
                            setTimeout(() => cardToRemove.remove(), 300);
                        }
                    } else {
                        alert("Erro ao excluir: " + (data.message || "Tente novamente"));
                    }
                })
                .catch(err => {
                    console.error("Erro na requisição:", err);
                    alert("Erro de comunicação com o servidor.");
                });
            });
        });
    });
    </script>
</body>
</html>