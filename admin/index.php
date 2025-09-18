<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

//var_dump($_POST);

//importar la base de datos y validacion
require '../includes/config/database.php';
$baseDatos = conexionBaseDatos();
// if($baseDatos) {
//   echo 'Conexion exitosa';
// } else {
//   echo 'error de conexion';
// }

$ConsultaServicios = 'SELECT * FROM sevicios';
$RConServicios = mysqli_query($baseDatos, $ConsultaServicios);

//Comprobar que esten los valores despues de enviar el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);
  //var_dump($id);

  if($id) {
    //Eliminar la imagen 
    $queryImagen = "SELECT imagen FROM sevicios WHERE id = $id";
    //echo $queryImagen; visualizar query
    $rCImagen = mysqli_query($baseDatos, $queryImagen);
    $datoImagen = mysqli_fetch_assoc($rCImagen);
    //var_dump($datoImagen);
    unlink('../src/imagenes/' . $datoImagen['imagen']);

    //Eliminacion de servicio
    $queryEliminar = "DELETE FROM sevicios WHERE id = $id";
    //echo $queryEliminar;
    $resultadoEliminar = mysqli_query($baseDatos, $queryEliminar);
    
    if($resultadoEliminar) {
      header('Location: /admin?registro=3');
    }
  } 
}



//Obtener un mensaje de servicio creado mediante la propiedad header despues de direccionar
//echo '<pre>';
//var_dump($_GET);
//echo '</pre>';
$registroServicio = $_GET['registro'] ?? null; //se pone ?? null; para evitar el mensaje de error que en caso que no encuentre algun valor en el registro


require  '../includes/funciones.php';
incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Administrador de servicios</h1>
    <?php if($registroServicio === '1') : ?> <!--Tambien se puede usar intval() sobre $registroServicio para convertir el valor a entero y con ello funcione--> 
      <div class="alerta creado">Servicio creado correctamente</div>
    <?php elseif($registroServicio === '2'): ?>
      <div class="alerta actualizado">Servicio actualizado correctamente</div>
    <?php elseif($registroServicio === '3'): ?>
      <div class="alerta error">Servicio eliminado correctamente</div>
    <?php endif;?>
    
    <a href="/admin/propiedades//crear.php" class="boton-amarillo ">Nuevo servicio</a>

    <table class="servicios">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Imagen</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while($servicio = mysqli_fetch_assoc($RConServicios)):  ?>
        <tr>
          <td><?php echo $servicio['id'] ?></td>
          <td><?php echo $servicio['nombre'] ?></td>
          <td><img src="/src/imagenes/<?php echo $servicio['imagen'] ?>" alt="imagentabla" class="imagentabla"></td>
          <td><?php echo $servicio['precio'] ?></td>
          <td>
            <form action="" method="POST" class="eliminacion">
              <input type="hidden" name="id" value="<?php echo $servicio['id']; ?>" > <!--Se pone este input oculto para poder enviar esa informacion y con ello poder utilizarla para realizar acciones -->
              <input class="boton-azul-block" type="submit" value="Eliminar">
            </form>
            
            <a href="/admin/propiedades/actualizar.php?idServicio=<?php echo $servicio['id']; ?>" class="boton-amarillo-block">Actualizar</a> <!--Se un campo de rastreo que es idServicio= el id que se pretende editar o actualizar (en el navegador se puede ver poniendo puntero hacia donde nos lleva el enlace) -->
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>

<?php 

mysqli_close($baseDatos);
incluirTemplate('footer');
?>