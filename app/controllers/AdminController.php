<?php

use Exception;
 

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $usuario = $_POST['username'] ?? '';
    $senha = $_POST['password'] ?? '';

    if($usuario === 'admin' && $senha === '123456'){

        session_start();
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/dashboard');
        exit();
    } else {
        // Credenciais inválidas
        http_response_code(401);
        echo "Credenciais inválidas.";
        exit();

    }    

}