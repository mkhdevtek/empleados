<?php

require 'conexion.php';

$name = "";
$apel = "";
$user = "";
$email = "";
$fecha_nac = "";
$phone = "";
$pob = "";
$pass = "";

if( !empty($_POST['user']) || !empty($_POST['password']) ){

  $name = $_POST['name'];
  $apel = $_POST['apellidos'];
  $user = $_POST['user'];
  $email = $_POST['email'];
  $fecha_nac = $_POST['date_birth'];
  $phone = $_POST['phone'];
  $pob = $_POST['poblacion'];
  $pass = $_POST['password'];
  $pass = sha1($pass);

  $query = "INSERT INTO users (`user`, `pass`, `nombre`, `apellido_s`, `fecha_nac`, `mail`, `num_phone`, `poblacion`) 
            VALUES('$user', '$pass','$name','$apel','$fecha_nac', '$email','$phone','$pob')";

  echo $query;

  if (mysqli_query($con, $query)) {
    echo "New record created successfully";
    header ("location: index.php");
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
  }
  mysqli_close($con);
}
else{
  echo "ERROR! - Intruduzca usuario y/o contraseña";
}