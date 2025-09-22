<?php
use Config\database;

class CalendarioParoquial {

    public function mostrarCalendario() {
        $eventos = $this->buscarProgramacao();
        require dirname(__DIR__) . '/views/CalendarioParoquial.php';
    }

    public function cadastrarProgramacao() {
        $connection = new Database();

        $titulo = $_POST['titulo'];
        $dia = $_POST['dia_semana'];
        $tipo = $_POST['tipo']; 
        $hora = $_POST['horario'];

        try {
            $query = "INSERT INTO calendario_paroquial (titulo, tipo, dia_semana, horario) 
                      VALUES (:titulo, :tipo, :dia, :hora)";
            $parametros = $connection->getConnection()->prepare($query);
            $parametros->bindParam(':titulo', $titulo);
            $parametros->bindParam(':tipo', $tipo);
            $parametros->bindParam(':dia', $dia);
            $parametros->bindParam(':hora', $hora);

            $result = $parametros->execute();
            if ($result) {
                echo "<script>alert('Evento cadastrado com sucesso!'); window.location.href = 'calendarioParoquial';</script>";
                exit();
            } else {
                echo "<script>alert('Erro ao cadastrar evento. Tente novamente.'); window.location.href = 'calendarioParoquial';</script>";
                exit();
            }
        } catch (Exception $e) {
            die("Erro: " . $e->getMessage());
        }
    }
    public function buscarProgramacao() { 
        $connection = new Database();
        $db = $connection->getConnection();
        
        $query = "SELECT * FROM calendario_paroquial ORDER BY dia_semana ";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function editarProgramacao() {
    $connection = new Database();
    $db = $connection->getConnection();

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $dia = $_POST['dia_semana'];
    $tipo = $_POST['tipo'];
    $hora = $_POST['horario'];

    try {
        $query = "UPDATE calendario_paroquial 
                  SET titulo = :titulo, tipo = :tipo, dia_semana = :dia, horario = :hora 
                  WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':dia', $dia);
        $stmt->bindParam(':hora', $hora);

        if ($stmt->execute()) {
            echo "<script>alert('Evento atualizado com sucesso!'); window.location.href = 'calendarioParoquial';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao atualizar evento.'); window.location.href = 'calendarioParoquial';</script>";
            exit();
        }
    } catch (Exception $e) {
        die("Erro: " . $e->getMessage());
    }
}

public function excluirProgramacao() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $connection = new Database();
        $db = $connection->getConnection();

        try {
            $query = "DELETE FROM calendario_paroquial WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erro ao excluir.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        exit;
    }
}

}