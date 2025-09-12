<?php 
  //funcion para conectar a la base de datos con las credenciales y apuntando a la base de datos
  function conexionBaseDatos() : mysqli {
    $baseDatos = mysqli_connect('localhost', 'root', '2705', 'autolavado_muymuy');
    if(!$baseDatos) {
      echo 'Error en la conexion';
      exit;
    }

    return $baseDatos;
  }