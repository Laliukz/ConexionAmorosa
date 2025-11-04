<?php
include 'includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $nombre = isset($_POST["nombre"]) ? $conn->real_escape_string($_POST["nombre"]) : '';
    $edad = isset($_POST["edad"]) ? $conn->real_escape_string($_POST["edad"]) : '';
    $genero = isset($_POST["genero"]) ? $conn->real_escape_string($_POST["genero"]) : '';
    $email = isset($_POST["email"]) ? $conn->real_escape_string($_POST["email"]) : '';
    $contraseña = isset($_POST["contraseña"]) ? $conn->real_escape_string($_POST["contraseña"]) : '';

    // Use prepared statement to insert new user
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, edad, genero, email, `contraseña`) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param('sssss', $nombre, $edad, $genero, $email, $contraseña);
        if ($stmt->execute()) {
            $id_usuario = $stmt->insert_id ? $stmt->insert_id : $conn->insert_id;
            $stmt->close();
            header("Location: Perfil.php?id_usuario=" . $id_usuario . "&nombre=" . urlencode($nombre) . "&edad=" . urlencode($edad));
            exit;
        } else {
            echo "Error al registrar los datos: " . $stmt->error;
        }
    } else {
        // Fallback to raw query if prepare fails
        $sql = "INSERT INTO usuarios (nombre, edad, genero, email, `contraseña`) VALUES ('$nombre', '$edad', '$genero', '$email', '$contraseña')";
        if ($conn->query($sql) === TRUE) {
            $id_usuario = $conn->insert_id;
            header("Location: Perfil.php?id_usuario=" . $id_usuario . "&nombre=" . urlencode($nombre) . "&edad=" . urlencode($edad));
            exit;
        } else {
            echo "Error al registrar los datos: " . $conn->error;
        }
    }
}
?>
