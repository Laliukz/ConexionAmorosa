<?php
include 'includes/conexion.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/Registro.css">
  <title>Registro</title>
</head>
<body>
    <header>
      <h1 align="center">Regístrate</h1>
    </header>
    <main>
      <form class="datos" action="procesar.php" method="POST">
        <label for="nombre">Nombre:</label>
        <div class="container">
            <svg class="iconos" viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
            </svg>
            <input name="nombre" type="text" class="input" id="nombre" placeholder="Name here" required>
        </div>  
        <label for="edad">Fecha de nacimiento:</label>
        <div class="container">
            <svg class="iconos" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
            </svg>
          <input type="date" class="input" id="edad" name="edad" min="1950-01-01" max="2006-01-01" required>
        </div> 
        <label for="genero">Género:</label>
        <div class="container">
            <svg class="iconos" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
              </svg>
          <select id="genero" name="genero" required>
            <option value="">Seleccione su género</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="other">Otro</option>
          </select>
        </div>
        <div><br><br></div>  
        <div class="email-password">
          <label for="email">Email:</label>
          <div class="container">
            <svg class="iconos" viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
              </svg>
            <input type="email" class="input" id="usuario" name="email" placeholder="example@example.com" required>
          </div>
          <label for="contraseña">Contraseña:</label>
          <div class="container">  
            <svg class="iconos" viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
              </svg>
            <input type="password" class="input" id="contraseña" name="contraseña" placeholder="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z\d]).{8,}" title="La contraseña debe contener al menos 8 caracteres, una letra minúscula, una mayúscula, un número y un símbolo" required>
          </div>
          <label class="desc">Confirmar contraseña:</label>
          <div class="container">  
            <svg class="iconos" viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
              </svg>
            <input name="conf_contraseña" type="password" class="input" id="conf_contraseña" name="conf_contraseña" placeholder="Contraseña" required>
            <span id="error-message" style="color: red; display: none;">Las contraseñas no coinciden.</span>
          </div>
        </div> 
        <div class="container_tyc">
          <input type="checkbox" id="terminos" style="display: none;" name="terminos" required>
          <label for="terminos" class="check">
            <svg width="18px" height="18px" viewBox="0 0 18 18">
                <path d="M1,9 L1,3.5 C1,2 2,1 3.5,1 L14.5,1 C16,1 17,2 17,3.5 L17,14.5 C17,16 16,17 14.5,17 L3.5,17 C2,17 1,16 1,14.5 L1,9 Z"></path>
                <polyline points="1 9 7 14 15 4"></polyline>
              </svg>
          </label>
          <label for="terminos">Acepto los <a href="https://www.google.com" target="_blank">Términos y condiciones</a> de la página.</label>
          <button type="submit" class="enviar"id="registroButton">Registrarse</button>
        </div>
      </form>
      <form class="cuenta">
        <div class="container_cuenta">
          <label for="preg_cuenta">¿Ya tienes una cuenta?</label>
          <button type="submit" onclick="window.location.href='Inicio_sesion.php'">Inicia sesión</button>
        </div>
      </form>
    </main>
    <footer></footer>
  <script src="assets/js/Registro.js"></script>
  </body>
</html>