<?php 
include '../../includes/templates/header.php';
?>

  <main class="contenedor seccion">
    <h1>Contacto</h1>
    <img src="/src/imagenes/contacto.png" alt="contacto" loading="lazy">
    <h2>Llene el formulario de contacto</h2>
    <form action="" class="formulario">
      <fieldset>
        <legend>Informacion Personal</legend>
        <label for="nombre">Nombre</label>
        <input type="text" placeholder="Tu Nombre" id="nombre">

        <label for="email">Email</label>
        <input type="email" placeholder="Tu email" id="email">

        <label for="telefono">Telefono</label>
        <input type="tel" placeholder="Tu tel" id="telefono">

        <label for="mensaje">Mensaje</label>
        <textarea name="" id="mensaje"></textarea>
      </fieldset>

      <fieldset>
        <legend>Informacion del servicio</legend>
        <label for="opciones">Tipo de servicio</label>
        <select name="" id="opciones">
          <option value="" disabled selected>--Seleccione--</option>
          <option value="basico">Sercicio basico</option>
          <option value="premium">Servicio Premium</option>
        </select>
      </fieldset>

      <fieldset>
        <legend>Contacto</legend>
        <p>Medio de deseado de contacto</p>
        <div class="forma-contacto">
          <label for="contacto-telefono">Contactar mediante llamada</label>
          <input name="contacto" type="radio" value="telefono" id="contacto-telefono">

          <label for="contacto-email">Contactar mediante email</label>
          <input name="contacto" type="radio" value="email" id="contacto-email">
        </div>

        <p>Si eligio telefono, seleccione la fecha y la hora</p>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="9:00" max="18:00">
      </fieldset>

      <input type="submit" value="Enviar" class="boton-amarillo">
    </form>
  </main>

<?php include  '../autolavado/includes/templates/footer.php';?>