console.log('Desde JS Prueba');

document.addEventListener('DOMContentLoaded', function () {
  listadoDeEventos();
  darkmode();
});

function listadoDeEventos() {
  const mobileMenu = document.querySelector('.mobil-menu');
  mobileMenu.addEventListener('click', navegacionResponsive);
}

function navegacionResponsive () {
  //console.log('Diste click en el menu responsivo');
  const navegacion = document.querySelector('.navegacion');

  navegacion.classList.toggle('mostrar');
}


function darkmode () {
  const botonDarckMode = document.querySelector('.dark-mode-boton');
  botonDarckMode.addEventListener('click', function () {
    document.body.classList.toggle('swhitch-mode');
  });
}

