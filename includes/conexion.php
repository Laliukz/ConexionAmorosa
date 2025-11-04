<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conexionamorosa";

// Establish connection with exception handling to catch mysqli_sql_exception
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    $err = $e->getMessage();
    // If the error indicates the database is unknown, try to create it (requires privileges)
    if (stripos($err, 'Unknown database') !== false) {
        try {
            // Connect without selecting a database
            $temp = new mysqli($servername, $username, $password);
        } catch (mysqli_sql_exception $e2) {
            die("Connection failed: " . $e2->getMessage());
        }

        $create_db_sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if ($temp->query($create_db_sql) === TRUE) {
            $temp->close();
            // Reconnect to the newly created database
            try {
                $conn = new mysqli($servername, $username, $password, $dbname);
            } catch (mysqli_sql_exception $e3) {
                die("Connection failed after creating database: " . $e3->getMessage());
            }
        } else {
            die("Error creating database: " . $temp->error);
        }
    } else {
        die("Connection failed: " . $err);
    }
}
// If mysqli warnings are enabled and no exception was thrown, still check for connect_error
if (isset($conn) && $conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure core tables exist (helps when scripts run in different orders)
$create_users_sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150),
    email VARCHAR(255) NOT NULL UNIQUE,
    `contraseña` VARCHAR(255),
    edad VARCHAR(50),
    genero VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
// We attempt creation but do not die if it fails (lack of privileges will be surfaced later)
if (!$conn->query($create_users_sql)) {
    // error_log("Could not ensure 'usuarios' table exists: " . $conn->error);
}

// Ensure tabla_datos exists too (used by Busqueda.php)
$create_tabla_datos = "CREATE TABLE IF NOT EXISTS tabla_datos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    ubicacion VARCHAR(255),
    distancia INT,
    edad INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($create_tabla_datos)) {
    // error_log("Could not ensure 'tabla_datos' table exists: " . $conn->error);
}

// Ensure intereses exists as well
$create_intereses = "CREATE TABLE IF NOT EXISTS intereses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    preferencia VARCHAR(50),
    acerca_de_mi TEXT,
    hobbies TEXT,
    musica_favorita TEXT,
    nivel_estudios TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
if (!$conn->query($create_intereses)) {
    // error_log("Could not ensure 'intereses' table exists: " . $conn->error);
}

// Ensure 'genero' column exists in usuarios (ALTER if table existed without it)
$checkGenero = $conn->query("SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '" . $conn->real_escape_string($dbname) . "' AND TABLE_NAME = 'usuarios' AND COLUMN_NAME = 'genero'");
if ($checkGenero) {
    $row = $checkGenero->fetch_assoc();
    if (isset($row['cnt']) && intval($row['cnt']) === 0) {
        // Add the column
        $alter = "ALTER TABLE usuarios ADD COLUMN genero VARCHAR(50)";
        $conn->query($alter);
    }
    $checkGenero->free();
}
?>