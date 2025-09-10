import gulpSass from 'gulp-sass';
import * as dartSass from 'sass';
import {src, dest, watch, series} from 'gulp';

// export function hola(done) {
//   console.log('Desde GulpFile');

//   done()
// }

const estilosSass = gulpSass(dartSass)

//FUNCION DE COMPILACION DE ESTILOS
export function compilacionCss( done ) {
  console.log('Funcion compilacion css');
  src( 'src/scss/app.scss' )
    .pipe( estilosSass().on( 'error', estilosSass.logError) )
    .pipe( dest( 'build/css') )
  done()
}

//FUNCION DE COMPILACION DE JS
export function javaSript( done ) {
  console.log('Compilacion de js...');
  src( 'src/js/modernizr.js')
    .pipe( dest( 'build/js') )
  src( 'src/js/app.js')
    .pipe( dest( 'build/js') )
  done()
}


//FUNCION DE VISUALIZACION DE CAMBIOS Y APLICACION DE FUNCIONES
export function dev() {
  watch('src/scss/**/*.scss', compilacionCss);
  watch( 'src/js/**/*.js', javaSript)
}

export default series(javaSript, compilacionCss, dev);