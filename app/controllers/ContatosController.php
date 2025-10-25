<?php
use Config\database;

class ContatosController {

    public function mostrarPainelAdmin() {
        
        $contatos = $this->listarContatos();
        require dirname(__DIR__) . '/views/ContatosAdmin.php';
    }

    /**
     * Processa o cadastro de um novo contato.
     */
    public function cadastrarContato() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: contatos-admin'); exit();
        }

        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $connection = new Database();
        $db = $connection->getConnection();
        
        try {
            $query = "INSERT INTO contatos (nome, funcao, telefone, email) VALUES (:nome, :funcao, :telefone, :email)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                ':nome' => $nome, ':funcao' => $funcao, ':telefone' => $telefone, ':email' => $email
            ]);
            echo "<script>alert('Contato cadastrado com sucesso!'); window.location.href = 'contatos-admin';</script>";
        } catch (Exception $e) {
            die("Erro ao cadastrar contato: " . $e->getMessage());
        }
        exit();
    }

    /**
     * Processa a edição de um contato existente.
     */
    public function editarContato() {
         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: contatos-admin'); exit();
        }
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $funcao = $_POST['funcao'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];

        $connection = new Database();
        $db = $connection->getConnection();

        try {
            $query = "UPDATE contatos SET nome = :nome, funcao = :funcao, telefone = :telefone, email = :email WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->execute([
                 ':id' => $id, ':nome' => $nome, ':funcao' => $funcao, ':telefone' => $telefone, ':email' => $email
            ]);
            echo "<script>alert('Contato atualizado com sucesso!'); window.location.href = 'contatos-admin';</script>";
        } catch (Exception $e) {
            die("Erro ao atualizar contato: " . $e->getMessage());
        }
        exit();
    }

    /**
     * Processa a exclusão de um contato.
     */
    public function excluirContato() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $connection = new Database();
            $db = $connection->getConnection();

            header('Content-Type: application/json');
            try {
                $query = "DELETE FROM contatos WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao executar exclusão.']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
        }
    }

    // --- Função para a Página Pública ---

    /**
     * Exibe a página pública de contatos.
     */
    public function exibirPaginaPublica() {
        $contatos = $this->listarContatos();
        require dirname(__DIR__) . '/views/NossosContatos.php';
    }

    // --- Funções Auxiliares ---

    /**
     * Busca todos os contatos no banco de dados.
     */
    private function listarContatos() {
        $connection = new Database();
        $db = $connection->getConnection();
        $query = "SELECT * FROM contatos ORDER BY nome ASC";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}