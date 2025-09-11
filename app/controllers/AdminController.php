<?php

class AdminController {

    public function mostrarLogin(){
        require dirname(__DIR__) . '/views/AdminLogin.php';
    }

    public function processarLogin(){
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $usuario = $_POST['username'] ?? '';
            $senha = $_POST['password'] ?? '';

            if($usuario === 'admin' && $senha === '123456'){
                header('Location: homeAdmin');
                exit();
            } else {
                echo "<script>alert('Credenciais inválidas. Tente novamente.'); window.location.href = 'admin';</script>";
                exit();

            }    

        }
    }
}