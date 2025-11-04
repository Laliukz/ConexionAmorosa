<?php
include 'includes/conexion.php';
session_start();
// Ensure the 'tabla_datos' table exists to avoid fatal errors when inserting.
$create_table_sql = "CREATE TABLE IF NOT EXISTS tabla_datos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    ubicacion VARCHAR(255),
    distancia INT,
    edad INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($create_table_sql)) {
    // If creation fails due to privileges, the subsequent queries will surface helpful errors.
    // error_log("Could not create 'tabla_datos' table: " . $conn->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Use safe checks to avoid 'Undefined array key' warnings
    $ubicacion = isset($_POST['ubicacion']) ? $conn->real_escape_string($_POST['ubicacion']) : '';
    $distancia = isset($_POST['distancia']) ? intval($_POST['distancia']) : 50;
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 18;
    $userId = isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0;

    if ($userId <= 0) {
        // Redirect to login when user is not identified. Preserve return URL so user can continue after login.
        $current = htmlspecialchars($_SERVER['REQUEST_URI']);
        header("Location: Inicio_sesion.php?next=" . urlencode($current));
        exit();
    } else {
        // Use a prepared statement for safety
        $stmt = $conn->prepare("INSERT INTO tabla_datos (id_usuario, ubicacion, distancia, edad) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param('isii', $userId, $ubicacion, $distancia, $edad);
            if ($stmt->execute()) {
                header("Location: Resultado_bus.php");
                exit();
            } else {
                echo "Error al guardar los datos: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuentra gente!</title>
    <link rel="stylesheet" href="assets/css/Busqueda.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY&libraries=places"></script>
</head>
<body onload="initMap()">
    <header>
        <div class="title"><h1>Buscar personas</h1></div>
    </header>
    <form action="" method="POST">
        <div class="busqueda">
            <label for="ubi">Ubicación: </label>
            <div class="ubi"></div>
            <!-- keep the image but add a hidden input so the form posts 'ubicacion' even if JS doesn't set it -->
            <img src="assets/img/ubicacion.jpg" id="ubicacion_img" alt="ubicacion">
            <input type="hidden" name="ubicacion" id="ubicacion_input" value="">
            <button type="button" onclick="buscarUbicacion()">Buscar</button>
            <!-- <div id="map" style="width: 100%; height: 400px;"></div> -->
            <br>
            <div id="distancia">
                <label for="distancia" id="distancia-label">Preferencia de distancia: </label>
                <input type="range" name="distancia" id="dis" max="100" class="range">
                <span id="pref-dis">0 km</span>
            </div>
            <br>
            <div id="pref-edad">
                <label for="edad">Preferencia de edad: </label>
                <input type="range" name="edad" id="edad" class="range" min="18" max="60">
                <span class="pref"> 18 años hasta </span>
                <span class="pref" id="18"> 18 años</span>
            </div>
            <br>
            <div class="boton">
                <button type="submit" class="enviar">Buscar</button>
            </div>
        </div>
    </form>
    <footer>
    </footer>
</body>
<script src="assets/js/Busqueda.js"></script>
</html>

