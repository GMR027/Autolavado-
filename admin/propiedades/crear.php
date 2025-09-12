<?php 
//Base de datos conexion
require '../../includes/config/database.php';
$baseDatos = conexionBaseDatos();
//var_dump($_POST);// Pra imprimir y ver los datos escritos y enviados en el formulario

//visualizacion de datos de servidor y datos adicionales
//echo "<pre>";
//var_dump($_SERVER['REQUEST_METHOD']);
//echo "</pre>";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Impresion de los campos escritos en el formulario
  echo "<pre>";
    var_dump($_POST); //Tambien existe el metodo GET pero este imprime la informacion en la url
  echo "</pre>";

 //Estos valores son los que se leen del formulario (NO de la base de datos)
  $nombre = $_POST['S_nombre'];
  $precio = $_POST['S_precio'];
  $descripcion = $_POST['S_descripcion'];
  $extra = $_POST['S_extra'];
  $extra2 = $_POST['S_extra2'];
  $extra3 = $_POST['S_extra3'];
  $trabajador = $_POST['T_empleados']; //este corresponde a trabajadores_id


  //Insertar a la base de datos apuntando a las propiedades de serivicios y la conexta con los valores conectados a las variables mediante la propiedad name
  $query = "INSERT INTO sevicios 
  (nombre, precio, descripcion, extra, extra2, extra3, trabajadores_id) 
  VALUES ('$nombre', '$precio', '$descripcion', '$extra', '$extra2', '$extra3', '$trabajador')";

  echo $query;
}

require  '../../includes/funciones.php';
incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton-amarillo ">Regresar</a>
    <form action="" class="formulario" method="POST" action='/admin/propiedades/crear.php'>
      <fieldset>
        <legend>Informacion general</legend>
        <label for="nombre">Nombre servicio</label>
        <input type="text" placeholder="Nombre de servicio" id="nombre" name="S_nombre">

        <label for="precio">Precio de servicio</label>
        <input type="number" placeholder="Precio" id="precio" name="S_precio">

        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="S_imagen">

        <label for="descripcion">Descripcion</label>
        <textarea name="S_descripcion" id="descripcion">Descripcion del servicio</textarea>
      </fieldset>

      <fieldset>
        <legend>Informacion del servicio</legend>
        <label for="extra">Tiempo de servicio</label>
        <input type="number" placeholder="Tiempo" id="extra" min="1" max="60" name="S_extra"> 

        <label for="extra2">Numero de limpiadores</label>
        <input type="number" placeholder="Numero" id="extra2" min="1" max="3" name="S_extra2">

        <label for="extra3">Tipo servicio</label>
        <input type="number" placeholder="1 bajo 3 premium" id="extra3" min="1" max="3" name="S_extra3">
      </fieldset>

      <fieldset>
        <legend>Trabajadores</legend>
        <select name="T_empleados" id="">
          <option value="1">Edgar</option>
          <option value="2">Elvira</option>
        </select>
      </fieldset>

      <input type="submit" value="Crear servicio" class="boton-amarillo">
    </form>
  </main>

<?php incluirTemplate('footer');?>