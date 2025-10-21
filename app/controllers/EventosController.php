<?php

use Config\database;

class EventosController {

    public function mostrarPainel() {
        $eventos = $this->listarEventos();
        require dirname(__DIR__) . '/views/EventosAdmin.php';
    }

    private function listarEventos() {
        $connection = new Database();
        $db = $connection->getConnection();
        $query = "SELECT id, nome, data_evento, horario, local, descricao, imagem FROM eventos ORDER BY data_evento DESC";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarEvento() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: eventos');
            exit();
        }

        $nome = $_POST['nome'];
        $data_evento = $_POST['data_evento'];
        $horario = $_POST['horario'];
        $local = $_POST['local'];
        $descricao = $_POST['descricao'];
        $imagemBinaria = null;

        
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $imagemBinaria = file_get_contents($_FILES['imagem']['tmp_name']);
        }

        $connection = new Database();
        $db = $connection->getConnection();
        
        try {
            $query = "INSERT INTO eventos (nome, data_evento, horario, local, descricao, imagem) 
                      VALUES (:nome, :data_evento, :horario, :local, :descricao, :imagem)";
            $stmt = $db->prepare($query);

            // Vincula os parâmetros, tratando a imagem como um BLOB
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':data_evento', $data_evento);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(':local', $local);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':imagem', $imagemBinaria, PDO::PARAM_LOB); // PDO::PARAM_LOB é essencial aqui!

            $stmt->execute();
            
            echo "<script>alert('Evento cadastrado com sucesso!'); window.location.href = 'gerenciar-eventos';</script>";

        } catch (Exception $e) {
            die("Erro ao cadastrar evento: " . $e->getMessage());
        }
        exit();
    }
     public function listarProximosEventos($limite = 3) {
        $connection = new Database();
        $db = $connection->getConnection();
        // A cláusula WHERE garante que apenas eventos futuros ou de hoje sejam mostrados
        $query = "SELECT * FROM eventos WHERE data_evento >= CURDATE() ORDER BY data_evento ASC LIMIT :limite";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function editarEvento() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: eventos');
            exit();
        }

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $data_evento = $_POST['data_evento'];
        $horario = $_POST['horario'];
        $local = $_POST['local'];
        $descricao = $_POST['descricao'];
        
        $connection = new Database();
        $db = $connection->getConnection();

        try {
            // Prepara a query SQL base
            $sql = "UPDATE eventos SET nome = :nome, data_evento = :data_evento, horario = :horario, local = :local, descricao = :descricao";
            
            // Prepara os parâmetros para a query
            $params = [
                ':id' => $id,
                ':nome' => $nome,
                ':data_evento' => $data_evento,
                ':horario' => $horario,
                ':local' => $local,
                ':descricao' => $descricao
            ];

            // Se uma nova imagem for enviada, adiciona a atualização da imagem à query
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $imagemBinaria = file_get_contents($_FILES['imagem']['tmp_name']);
                $sql .= ", imagem = :imagem";
                $params[':imagem'] = $imagemBinaria;
            }

            $sql .= " WHERE id = :id";
            $stmt = $db->prepare($sql);
            
            // Faz o bind dos parâmetros, tratando a imagem como um BLOB se ela existir
            $stmt->bindParam(':id', $params[':id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome', $params[':nome']);
            $stmt->bindParam(':data_evento', $params[':data_evento']);
            $stmt->bindParam(':horario', $params[':horario']);
            $stmt->bindParam(':local', $params[':local']);
            $stmt->bindParam(':descricao', $params[':descricao']);
            if (isset($params[':imagem'])) {
                $stmt->bindParam(':imagem', $params[':imagem'], PDO::PARAM_LOB);
            }
            
            $stmt->execute();
            
            echo "<script>alert('Evento atualizado com sucesso!'); window.location.href = 'eventos';</script>";

        } catch (Exception $e) {
            die("Erro ao atualizar evento: " . $e->getMessage());
        }
        exit();
    }

    public function excluirEvento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $connection = new Database();
            $db = $connection->getConnection();

            header('Content-Type: application/json');
            try {
                $query = "DELETE FROM eventos WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erro ao executar a exclusão.']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            }
            exit;
        }
    }
}