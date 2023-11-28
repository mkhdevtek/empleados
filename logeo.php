<?php
    require 'conexion.php';
    
    if (!empty($_POST['user']) and !empty($_POST['password'])){
        session_start();
        $usuario = $_POST['user'];
        $password = $_POST['password'];
        $pass_sha1 = sha1($password);
        
        $query = "SELECT COUNT(*) AS contar FROM users where user= '$usuario' and pass= '$pass_sha1'";
        
        $consulta = mysqli_query($con,$query);
        
        $array = mysqli_fetch_array($consulta);
        
        if ($array['contar'] > 0){
            $_SESSION['user'] = $usuario;
            header ("location: empleados.php");
        }else{
            echo "datos incorrectos";
        }
    }
    else{
        echo 'ERROR! - Intruduzca usuario y/o contraseña';
    }

?>