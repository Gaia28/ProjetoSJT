<?php
use Config\database;

class Pastorais {

    public function mostrarPastorais() {
        $pastorais = $this->buscarPastorais();
        require dirname(__DIR__) . '/views/Pastorais.php';
    }

    public function salvarPastoral() {
        $connection = new Database();
        $db = $connection->getConnection();

        $nomePastoral = $_POST['nome_pastoral'] ?? '';
        $coordenadores = $_POST['coordenadores'] ?? [];

        try {
            $db->beginTransaction();

            // Inserir pastoral
            $queryPastoral = "INSERT INTO pastorais (nome) VALUES (:nome)";
            $stmtPastoral = $db->prepare($queryPastoral);
            $stmtPastoral->bindParam(':nome', $nomePastoral);
            $stmtPastoral->execute();

            $pastoralId = $db->lastInsertId();

            // Inserir coordenadores
            if (!empty($coordenadores)) {
                $queryCoord = "INSERT INTO coordenadores (pastoral_id, nome, telefone) 
                               VALUES (:pastoral_id, :nome, :telefone)";
                $stmtCoord = $db->prepare($queryCoord);

                foreach ($coordenadores as $coord) {
                    $nome = $coord['nome'];
                    $telefone = $coord['telefone'] ?? null;

                    $stmtCoord->bindParam(':pastoral_id', $pastoralId, PDO::PARAM_INT);
                    $stmtCoord->bindParam(':nome', $nome);
                    $stmtCoord->bindParam(':telefone', $telefone);
                    $stmtCoord->execute();
                }
            }

            $db->commit();

            echo "<script>alert('Pastoral cadastrada com sucesso!'); window.location.href = 'Pastorais';</script>";
            exit();
        } catch (Exception $e) {
            $db->rollBack();
            die("Erro ao salvar pastoral: " . $e->getMessage());
        }
    }

    public function buscarPastorais() {
        $connection = new Database();
        $db = $connection->getConnection();

        // Buscar pastorais
        $queryPastorais = "SELECT * FROM pastorais ORDER BY nome";
        $stmt = $db->query($queryPastorais);
        $pastorais = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Buscar coordenadores e agrupar por pastoral
        foreach ($pastorais as &$pastoral) {
            $queryCoord = "SELECT * FROM coordenadores WHERE pastoral_id = :id";
            $stmtCoord = $db->prepare($queryCoord);
            $stmtCoord->bindParam(':id', $pastoral['id'], PDO::PARAM_INT);
            $stmtCoord->execute();
            $pastoral['coordenadores'] = $stmtCoord->fetchAll(PDO::FETCH_ASSOC);
        }

        return $pastorais;
    }

  public function excluirPastoral() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $connection = new Database();
        $db = $connection->getConnection();

        try {
            $query = "DELETE FROM pastorais WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<script>alert('Pastoral excluída com sucesso!'); window.location.href='Pastorais';</script>";
            exit();
        } catch (Exception $e) {
            die("Erro ao excluir pastoral: " . $e->getMessage());
        }
    }
}

}
