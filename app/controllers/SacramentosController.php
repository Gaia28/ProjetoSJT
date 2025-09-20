<?php
use Config\database;

class SacramentosController {

    public function mostrarSacramentos() {
        $sacramentos = $this->listarSacramentos(); 
        require dirname(__DIR__) . '/views/Sacramentos.php'; 
    }
    public function cadastrarSacramento() {
        $connection = new Database();

        $nome = $_POST['nome'];
        $valor = $_POST['valor'];
        $descricao = $_POST['descricao'];

        try {
            $query = "INSERT INTO sacramentos (nome, valor, descricao) 
                      VALUES (:nome, :valor, :descricao)";
            $parametros = $connection->getConnection()->prepare($query);
            $parametros->bindParam(':nome', $nome);
            $parametros->bindParam(':valor', $valor);
            $parametros->bindParam(':descricao', $descricao);

            $result = $parametros->execute();
            if ($result) {
                echo "<script>alert('Sacramento cadastrado com sucesso!'); window.location.href = 'sacramentos';</script>";
                exit();
            } else {
                echo "<script>alert('Erro ao cadastrar sacramento. Tente novamente.'); window.location.href = 'sacramentos';</script>";
                exit();
            }
        } catch (Exception $e) {
            die("Erro: " . $e->getMessage());
        }
    }
    public function listarSacramentos() {
        $connection = new Database();
        $db = $connection->getConnection();

        $query = "SELECT * FROM sacramentos ORDER BY nome";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function editarSacramento() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];
        $documentos = $_POST['documentos'];

        try {
            $conn = new Database();
            $db = $conn->getConnection();

            $sql = "UPDATE sacramentos 
                    SET nome = :nome, tipo = :tipo, valor = :valor, documentos = :documentos 
                    WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':tipo' => $tipo,
                ':valor' => $valor,
                ':documentos' => $documentos,
                ':id' => $id
            ]);

            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

public function deletarSacramento() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        try {
            $conn = new Database();
            $db = $conn->getConnection();

            $sql = "DELETE FROM sacramentos WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->execute([":id" => $id]);

            echo json_encode(["success" => true]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => $e->getMessage()]);
        }
    }
}

}
