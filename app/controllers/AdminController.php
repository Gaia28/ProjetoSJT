<?php
use Exception;

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $usuario = $_POST['username'] ?? '';
    $senha = $_POST['password'] ?? '';

    if($usuario === 'admin' && $senha === '123456'){
        header('Location: /views/HomeAdmin.php');
        exit();
    } else {
        // Credenciais inválidas
        http_response_code(401);
        echo "Credenciais inválidas.";
        exit();

    }    

}