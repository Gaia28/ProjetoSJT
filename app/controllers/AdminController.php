<?php
session_start();
class AdminController {

    public function mostrarLogin(){
        require dirname(__DIR__) . '/views/AdminLogin.php';
    }

    public function processarLogin(){
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $usuario = $_POST['username'] ?? '';
            $senha = $_POST['password'] ?? '';

            if($usuario === 'admin' && $senha === '123456'){
                $_SESSION['admin_logged_in'] = true;
                header('Location: homeAdmin');
                exit();
            } else {
                echo "<script>alert('Credenciais inválidas. Tente novamente.'); window.location.href = 'admin';</script>";
                exit();

            }    

        }
    }

    public function processarLogout() {
        $_SESSION = array();
        session_destroy();
        header('Location: admin');
        exit();
    }
}