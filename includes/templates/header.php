<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Auto Lavado</title>
  <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
  <header class="header <?php echo $inicio   ? 'inicio' : '' ?>"> <!-- Proteccion para la validacion de la variable inicio -->
    <div class="contenedor contenido-header">
      <div class="barra">
        <a href="/">
          <img src="/src/imagenes/logo.webp" alt="logo">
        </a>

        <div class="mobil-menu">
          <img src="/src/imagenes/barras.svg" alt="barras-menu">
        </div>

        <div class="derecha">
          <img src="/src/imagenes/dark-mode.svg" alt="dark-mode" class="dark-mode-boton">
          <nav class="navegacion">
            <a href="nosotros.php">Nosotros</a>
            <a href="servicios.php">Servicios</a>
            <a href="promociones.php">Promociones</a>
            <a href="contacto.php">Contacto</a>
          </nav>
        </div>

        
      </div> <!-- Cierre de barra de navegacion -->
      <h1>Autolavado express</h1>
    </div>
  </header><!--Header-->