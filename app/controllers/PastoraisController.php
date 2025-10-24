<?php
use Config\database;

class PastoraisController {

    public function mostrarPastorais() {
        $pastorais = $this->listarPastorais();
        require dirname(__DIR__) . '/views/PastoraisAdmin.php';
    }

    public function mostrarPastoraisPublico() {
        $pastorais = $this->listarPastorais();
        require dirname(__DIR__) . '/views/NossasPastorais.php';
    }

    private function listarPastorais() {
        $connection = new Database();
        $db = $connection->getConnection();
        
        $query = "SELECT 
                    p.id, 
                    p.nome,
                    GROUP_CONCAT(DISTINCT CONCAT(c.nome, '|', c.telefone) ORDER BY c.nome SEPARATOR ';') as coordenadores
                  FROM pastorais p
                  LEFT JOIN coordenadores c ON p.id = c.pastoral_id
                  GROUP BY p.id, p.nome
                  ORDER BY p.nome";
                  
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // NOVA FUNÇÃO: Busca os detalhes de uma pastoral para o AJAX
    public function getPastoralDetails() {
        header('Content-Type: application/json');
        $id = $_GET['id'] ?? 0;

        if ($id == 0) {
            echo json_encode(['error' => 'ID da pastoral não fornecido.']);
            exit;
        }

        $connection = new Database();
        $db = $connection->getConnection();

        $stmtPastoral = $db->prepare("SELECT id, nome FROM pastorais WHERE id = :id");
        $stmtPastoral->execute([':id' => $id]);
        $pastoral = $stmtPastoral->fetch(PDO::FETCH_ASSOC);

        if (!$pastoral) {
             echo json_encode(['error' => 'Pastoral não encontrada.']);
             exit;
        }

        $stmtCoords = $db->prepare("SELECT id, nome, telefone FROM coordenadores WHERE pastoral_id = :id");
        $stmtCoords->execute([':id' => $id]);
        $coordenadores = $stmtCoords->fetchAll(PDO::FETCH_ASSOC);

        $pastoral['coordenadores'] = $coordenadores;
        
        echo json_encode($pastoral);
        exit;
    }

    public function salvarPastoral() {
        // ... (A função que criamos anteriormente continua a mesma) ...
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: Pastorais');
            exit();
        }

        $connection = new Database();
        $db = $connection->getConnection();

        $nomePastoral = $_POST['nome_pastoral'] ?? '';
        $coordenadores = $_POST['coordenadores'] ?? [];

        if (empty($nomePastoral) || empty($coordenadores)) {
            echo "<script>alert('O nome da pastoral e pelo menos um coordenador são obrigatórios.'); window.location.href = 'Pastorais';</script>";
            exit();
        }

        try {
            $db->beginTransaction();

            $stmtPastoral = $db->prepare("INSERT INTO pastorais (nome) VALUES (:nome)");
            $stmtPastoral->bindParam(':nome', $nomePastoral);
            $stmtPastoral->execute();

            $idPastoral = $db->lastInsertId();

            $stmtCoord = $db->prepare("INSERT INTO coordenadores (nome, telefone, pastoral_id) VALUES (:nome, :telefone, :pastoral_id)");

            foreach ($coordenadores as $coord) {
                if (!empty($coord['nome'])) {
                    $stmtCoord->bindParam(':nome', $coord['nome']);
                    $stmtCoord->bindParam(':telefone', $coord['telefone']);
                    $stmtCoord->bindParam(':pastoral_id', $idPastoral, PDO::PARAM_INT);
                    $stmtCoord->execute();
                }
            }

            $db->commit();
            echo "<script>alert('Pastoral cadastrada com sucesso!'); window.location.href = 'Pastorais';</script>";

        } catch (Exception $e) {
            $db->rollBack();
            die("Erro ao cadastrar pastoral: " . $e->getMessage());
        }
        exit();
    }

    // FUNÇÃO ATUALIZADA: Agora edita a pastoral e seus coordenadores
    public function editarPastoral() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: Pastorais');
            exit();
        }

        $connection = new Database();
        $db = $connection->getConnection();

        $pastoralId = $_POST['id'] ?? 0;
        $pastoralNome = $_POST['nome_pastoral'] ?? '';
        $coordenadores = $_POST['coordenadores'] ?? [];

        try {
            $db->beginTransaction();

            // 1. Atualiza o nome da pastoral
            $stmtUpdate = $db->prepare("UPDATE pastorais SET nome = :nome WHERE id = :id");
            $stmtUpdate->execute([':nome' => $pastoralNome, ':id' => $pastoralId]);

            // 2. Remove os coordenadores antigos para simplificar a lógica
            $stmtDelete = $db->prepare("DELETE FROM coordenadores WHERE pastoral_id = :id");
            $stmtDelete->execute([':id' => $pastoralId]);

            // 3. Insere os coordenadores enviados pelo formulário (como se fossem novos)
            $stmtInsert = $db->prepare("INSERT INTO coordenadores (nome, telefone, pastoral_id) VALUES (:nome, :telefone, :pastoral_id)");
            foreach ($coordenadores as $coord) {
                if (!empty($coord['nome'])) {
                    $stmtInsert->execute([
                        ':nome' => $coord['nome'],
                        ':telefone' => $coord['telefone'],
                        ':pastoral_id' => $pastoralId
                    ]);
                }
            }

            $db->commit();
            echo "<script>alert('Pastoral atualizada com sucesso!'); window.location.href = 'Pastorais';</script>";

        } catch (Exception $e) {
            $db->rollBack();
            die("Erro ao atualizar pastoral: " . $e->getMessage());
        }
        exit();
    }

    public function deletarPastoral() {
        // ... (A função de deletar continua a mesma) ...
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $connection = new Database();
            $db = $connection->getConnection();

            try {
                $db->beginTransaction();

                $stmtCoord = $db->prepare("DELETE FROM coordenadores WHERE pastoral_id = :id");
                $stmtCoord->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtCoord->execute();
                
                $stmtPastoral = $db->prepare("DELETE FROM pastorais WHERE id = :id");
                $stmtPastoral->bindParam(':id', $id, PDO::PARAM_INT);
                $stmtPastoral->execute();

                $db->commit();

                header('Content-Type: application/json');
                echo json_encode(['success' => true]);

            } catch (Exception $e) {
                $db->rollBack();
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
        }
    }
}