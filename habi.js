document.addEventListener('DOMContentLoaded', function () {
    // Obtener referencia a los elementos del formulario y el botón
    var formulario = document.getElementById('env');
    var campo1 = document.getElementById('campo1');
    var campo2 = document.getElementById('campo2');
    var campo3 = document.getElementById('campo3');
    var boton = document.getElementById('miBoton');
    
    // Función para verificar si todos los campos están completos
    function verificarCamposCompletos() {
      if (campo1.value.trim() !== '' && campo2.value.trim() !== '' && campo3.value.trim() !== '') {
        boton.disabled = false; // Habilitar el botón si todos los campos están completos
        boton.classList.remove('boton-des'); // Eliminar clase que desactiva el color del botón
      boton.classList.add('boton-ac');
      } else {
        boton.disabled = true; // Deshabilitar el botón si algún campo está vacío
        boton.classList.remove('boton-ac'); // Eliminar clase que activa el color del botón
        boton.classList.add('boton-des');
      }
    }
    
    // Escuchar cambios en los campos del formulario
    campo1.addEventListener('input', verificarCamposCompletos);
    campo2.addEventListener('input', verificarCamposCompletos);
    campo3.addEventListener('input', verificarCamposCompletos);
    
    // Verificar campos completos al cargar la página
    verificarCamposCompletos();
  });
  