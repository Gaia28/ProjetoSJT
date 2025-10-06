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
}