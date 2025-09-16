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
        $tipo = $_POST['tipo']; // melhor usar select no form
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
        
        $query = "SELECT * FROM calendario_paroquial ORDER BY id DESC";
        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editarProgramacao() {
    }
}
