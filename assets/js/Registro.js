document.getElementById('formulario').addEventListener('submit', function(event) {
    var password = document.getElementById('contraseña').value;
    var confirmPassword = document.getElementById('conf_contraseña').value;
    var errorMessage = document.getElementById('error-message');
  
    if (password !== confirmPassword) {
      errorMessage.style.display = 'block';
      event.preventDefault(); 
    } else {
      errorMessage.style.display = 'none';
    }
  });
  document.getElementById('registroButton').addEventListener('click', function(event) {
    event.preventDefault();

  window.location.href = 'Perfil.php';
  });