// Validaciones para crear evento

document.addEventListener('DOMContentLoaded', function () {
  console.log('Script cargado correctamente');
  
  const form = document.getElementById('form-crear-evento');
  const nombre = document.getElementById('input-evento-nombre');
  const descripcion = document.getElementById('input-evento-descripcion');
  const categoria = document.getElementById('input-evento-categoria');
  const errorNombre = document.getElementById('error-nombre');
  const errorDescripcion = document.getElementById('error-descripcion');
  const errorCategoria = document.getElementById('error-categoria');
  const contadorDescripcion = document.getElementById('contador-descripcion');

  // Verificar que todos los elementos existan
  if (!contadorDescripcion) {
    console.error('No se encontró el elemento contador-descripcion');
    return;
  }
  
  if (!descripcion) {
    console.error('No se encontró el elemento input-evento-descripcion');
    return;
  }

  // Inicializar contador
  contadorDescripcion.textContent = '0/250';
  console.log('Contador inicializado');

  // Contador de caracteres para descripción
  descripcion.addEventListener('input', function () {
    console.log('Input detectado en descripción');
    let length = descripcion.value.length;
    if (length > 250) {
      descripcion.value = descripcion.value.substring(0, 250);
      length = 250;
    }
    contadorDescripcion.textContent = `${length}/250`;
    console.log(`Contador actualizado: ${length}/250`);
  });

  form.addEventListener('submit', function (e) {
    let valido = true;

    // Validar nombre
    if (!nombre.value.trim()) {
      errorNombre.style.display = 'block';
      valido = false;
    } else {
      errorNombre.style.display = 'none';
    }

    // Validar descripción
    if (!descripcion.value.trim() || descripcion.value.length > 250) {
      errorDescripcion.style.display = 'block';
      valido = false;
    } else {
      errorDescripcion.style.display = 'none';
    }

    // Validar categoría
    if (!categoria.value) {
      errorCategoria.style.display = 'block';
      valido = false;
    } else {
      errorCategoria.style.display = 'none';
    }

    if (!valido) {
      e.preventDefault();
    }
  });

  // Ocultar errores al escribir
  nombre.addEventListener('input', () => errorNombre.style.display = 'none');
  descripcion.addEventListener('input', () => errorDescripcion.style.display = 'none');
  categoria.addEventListener('change', () => errorCategoria.style.display = 'none');
});
