<?php 
//Base de datos conexion
require '../../includes/config/database.php';
$baseDatos = conexionBaseDatos();
//var_dump($_POST);// Pra imprimir y ver los datos escritos y enviados en el formulario

//visualizacion de datos de servidor y datos adicionales
//echo "<pre>";
//var_dump($_SERVER['REQUEST_METHOD']);
//echo "</pre>";`

//Consulta base de datos para obtener los empleados
$consultaEmpleados = 'SELECT * FROM  trabajadores';
$resultadoConsultaEmpleados = mysqli_query($baseDatos, $consultaEmpleados);

//Validador de datos ingresados
$error = [];


//Conservar los datos escritos en el formulario en caso que falte algun dato p3
$nombre = '';
$precio = '';
$descripcion = '';
$extra = '';
$extra2 = '';
$extra3 = '';
$trabajador = ''; //este corresponde a trabajadores_id

//Ejecucucion de codigo para enviar a base de datos p1
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  //Impresion de los campos escritos en el formulario
  //echo "<pre>";
    //var_dump($_POST); //Tambien existe el metodo GET pero este imprime la informacion en la url
  //echo "</pre>";

  //echo "<pre>";
    //var_dump($_FILES); //Superglobal para leer la informacion de los archivos (ejemplo los datos de las imagenes)
  //echo "</pre>";



 //Estos valores son los que se leen del formulario (NO de la base de datos)
  $nombre = mysqli_real_escape_string( $baseDatos, $_POST['S_nombre'] ); //mysqli_real_escape_string(basededatos, valor) esto sirve para poder sanitizar los datos y evitar danios con scripts que quieran danar el proyecto
  $precio = mysqli_real_escape_string( $baseDatos, $_POST['S_precio']);
  $descripcion = mysqli_real_escape_string( $baseDatos, $_POST['S_descripcion']);
  $extra = mysqli_real_escape_string( $baseDatos, $_POST['S_extra']);
  $extra2 = mysqli_real_escape_string( $baseDatos, $_POST['S_extra2']);
  $extra3 = mysqli_real_escape_string( $baseDatos, $_POST['S_extra3']);
  $trabajador = mysqli_real_escape_string( $baseDatos, $_POST['T_empleados']);//este corresponde a trabajadores_id
  $fechacreacion = date('Y/m/d');
  $imagen = $_FILES['S_imagen']; //asignacion de variable para imagenes

  //Condicionales para indicar si esta o no esta la informacion poder detener la inyeccion de datos a la base de datos p2
  if(!$nombre) {
    $error[] = 'Debes anadir un nombre';
  }

  if(!$precio) {
    $error[] = 'Debes anadir un un precio';
  }

  if(strlen($descripcion) < 50 ) { //el valor strlen sirve para medir la cantidad de datos o caracteres
    $error[] = 'Debes anadir una descripcion y debe tener al menos 50 caracteres';
  }

  if(!$extra) {
    $error[] = 'Debes anadir un tiempo de servicio';
  }

  if(!$extra2) {
    $error[] = 'Debes anadir un numero de limpiadores';
  }

  if(!$extra3) {
    $error[] = 'Debes anadir un tipo de servicio';
  }

  if(!$trabajador) {
    $error[] = 'Debes anadir un trabajador';
  }

  if(!$imagen['name'] || $imagen['error']){ //validacion que exita imagen
    $error[] = 'Debes ingresar una imagen';
  }
  
  $tamanoImagen = 1000 * 1000;
  if($imagen['size'] > $tamanoImagen) {
    $error[] = 'La imagen no debe pesar mas de 5MB';
  }

  //var_dump($error); ver mensajes de errores en caso de no ingresar algun campo

  //Validador que el arreglo de errores este vacio p2
  if(empty($error)) {

    //Creacion de carpeta y subida de archivos
    $carpetaImagenes = '../../src/imagenes/'; //Ruta a la carpeta principal de imagenes
    if(!is_dir($carpetaImagenes)) { //validador para verificar que no exista esta carpeta, caso contrario la va a crar (como ya existe no la va a crear)
      mkdir($carpetaImagenes);
    }

    //Generar nombre para imagenes
    $nombreIMG = md5(uniqid( rand(), true));

    //Subir la imagen en formatos jpg y png validando el formato
    if($imagen['type'] === 'image/jpg') {
      $nombreIMG .= '.jpg';
      move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreIMG );
    } else if($imagen['type'] === 'image/png') {
      $nombreIMG .= '.png';
      move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreIMG);
    } else {
      $error[] = 'El formato de la imagen es incompatible';
    }
    
    
    //exit; este exit es para validar e ir revisando paso a paso la conformacion de la subida de imagen

    //Insertar a la base de datos apuntando a las propiedades de serivicios y la conexta con los valores conectados a las variables mediante la propiedad name
    $query = "INSERT INTO sevicios 
    (nombre, precio, imagen, descripcion, extra, extra2, extra3, creado, trabajadores_id) 
    VALUES ('$nombre', '$precio', '$nombreIMG' , '$descripcion', '$extra', '$extra2', '$extra3', '$fechacreacion', '$trabajador')";

    //echo $query; visualizacion de query para su aplicacion

    $resutkado = mysqli_query($baseDatos, $query);

    if($resutkado) {
      //echo 'Insertado correctamente';

      //Redireccionar al usuario
      header('Location:/admin?registro=1');
    }
  } 
}

require  '../../includes/funciones.php';
incluirTemplate('header');
?>

  <main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton-amarillo ">Regresar</a>

    <?php foreach($error as $advertencia): ?>
      <div class="alerta error">
        <?php echo $advertencia;?>
      </div>
    <?php endforeach; ?> 

    <form action="" class="formulario" method="POST" action='/admin/propiedades/crear.php' enctype="multipart/form-data"> <!-- ectype este atributo es para poder enviar la informacion de archivos -->
      <fieldset>
        <legend>Informacion general</legend>
        <label for="nombre">Nombre servicio</label>
        <input type="text" placeholder="Nombre de servicio" id="nombre" name="S_nombre" value="<?php echo $nombre; ?>"><!--value es para poder asignar un valor y en este caso las variables vacias -->

        <label for="precio">Precio de servicio</label>
        <input type="number" placeholder="Precio" id="precio" name="S_precio" value="<?php echo $precio; ?>">

        <label for="imagen">Imagen</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png" name="S_imagen">

        <label for="descripcion">Descripcion</label>
        <textarea name="S_descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
      </fieldset>

      <fieldset>
        <legend>Informacion del servicio</legend>
        <label for="extra">Tiempo de servicio</label>
        <input type="number" placeholder="Tiempo" id="extra" min="1" max="60" name="S_extra" value="<?php echo $extra; ?>"> 

        <label for="extra2">Numero de limpiadores</label>
        <input type="number" placeholder="Numero" id="extra2" min="1" max="3" name="S_extra2" value="<?php echo $extra2; ?>">

        <label for="extra3">Tipo servicio</label>
        <input type="number" placeholder="1 bajo 3 premium" id="extra3" min="1" max="3" name="S_extra3" value="<?php echo $extra3; ?>">
      </fieldset>

      <fieldset>
        <legend>Trabajadores</legend>
        <select name="T_empleados" id="">
          <option value="" selected disabled>--Seleccione--</option>

      <!--codigo para iterar en los empleados y con ello poder seleccionar de la base de datos los empleados y que permita guardar la seleccion en caso que haya errores en la validacion de errores -->
          <?php while($empleado =  mysqli_fetch_assoc($resultadoConsultaEmpleados)):?>  <!-- la variable $empleado toma el dato de la base de datos y $trabajador la toma del formulario que unos selecciona-->
            <option <?php echo $trabajador === $empleado['id'] ? 'selected' : ''; ?> value="<?php echo $empleado['id']; ?>"><?php echo $empleado['nombre'] . ' ' .  $empleado['apellido']; ?></option>
          <?php endwhile ?>
        </select>
      </fieldset>

      <input type="submit" value="Crear servicio" class="boton-amarillo">
    </form>
  </main>

<?php incluirTemplate('footer');?>