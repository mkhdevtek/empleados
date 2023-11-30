<?php
    require 'conexion.php';
    //include ("conexion.php");
    if (!empty($_POST['username'])){
        session_start();
        $usuario = $_POST['username'];
        $password = $_POST['password'];
        
        $query = "SELECT COUNT(*) AS contar FROM usuarios where usuario= '$usuario' and password= '$password'";
        
        $consulta = mysqli_query($con,$query);
        
        $array= mysqli_fetch_array ($consulta);
        
        if ($array['contar']>0){
            $_SESSION['username']=$usuario;
            header ("location: empleados.php");
        }else{
            echo "datos incorrectos";
        }
    }

?>