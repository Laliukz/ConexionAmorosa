<?php
include 'includes/conexion.php';
session_start();

// Ensure the 'usuarios' table exists. If missing, create a minimal schema.
$create_users_sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150),
    email VARCHAR(255) NOT NULL UNIQUE,
    `contraseña` VARCHAR(255),
    edad VARCHAR(50),
    genero VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($create_users_sql)) {
    // log or ignore; subsequent queries will show the real error if creation is not permitted
    // error_log("Could not create 'usuarios' table: " . $conn->error);
}

// Basic validation to avoid undefined index warnings
if (!isset($_POST['email']) || !isset($_POST['contraseña'])) {
    header("Location: Inicio_sesion.php?error=true");
    exit();
}

$usuario = $_POST['email'];
$contrasena = $_POST['contraseña'];

// Use prepared statements for safety. Note: passwords appear stored plaintext in this app; migrating to password_hash() is recommended.
$stmt = $conn->prepare("SELECT id, nombre, edad FROM usuarios WHERE email = ? AND `contraseña` = ? LIMIT 1");
if ($stmt) {
    $stmt->bind_param('ss', $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $nombreValor = $row['nombre'];
        $edadValor = $row['edad'];
        $id_usuario = intval($row['id']);

        // set session and redirect to profile
        $_SESSION['id_usuario'] = $id_usuario;
        header("Location: Perfil.php?nombre=" . urlencode($nombreValor) . "&edad=" . urlencode($edadValor) . "&id_usuario=" . $id_usuario);
        exit();
    } else {
        header("Location: Inicio_sesion.php?error=true");
        exit();
    }
    $stmt->close();
} else {
    // fallback: if prepare fails, try a basic query (will still error if table missing)
    $query = "SELECT id, nombre, edad FROM usuarios WHERE email = '" . $conn->real_escape_string($usuario) . "' AND `contraseña` = '" . $conn->real_escape_string($contrasena) . "' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id_usuario = $row['id'];
        $_SESSION['id_usuario'] = $id_usuario;
        header("Location: Perfil.php?id_usuario=$id_usuario");
        exit();
    } else {
        header("Location: Inicio_sesion.php?error=true");
        exit();
    }
}

?>


