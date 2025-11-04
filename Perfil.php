<?php
include 'includes/conexion.php';

// Ensure the 'intereses' table exists. If it's missing, create it with sensible columns.
$create_table_sql = "CREATE TABLE IF NOT EXISTS intereses (
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
// Try to create the table; if this fails, we won't stop the script here but the subsequent queries will surface errors.
if (!$conn->query($create_table_sql)) {
    // Optionally log or handle the error; keep execution so the original error (if any) is visible to the developer.
    // error_log("Could not create 'intereses' table: " . $conn->error);
}

if (isset($_GET['nombre']) && isset($_GET['edad']) && isset($_GET['id_usuario'])) {
    $nombreValor = $_GET['nombre'];
    $edadValor = $_GET['edad'];
    // cast to int to avoid SQL injection via the id parameter
    $id_usuario = intval($_GET['id_usuario']);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape POST input values before building SQL queries
    $preferencia = isset($_POST["preferencia"]) ? $conn->real_escape_string($_POST["preferencia"]) : '';
    $acerca_de_mi = isset($_POST["acerca_de_mi"]) ? $conn->real_escape_string($_POST["acerca_de_mi"]) : '';
    $hobbies = isset($_POST["hobbies"]) ? $conn->real_escape_string($_POST["hobbies"]) : '';
    $musica_favorita = isset($_POST["musica_favorita"]) ? $conn->real_escape_string($_POST["musica_favorita"]) : '';
    $nivel_estudios = isset($_POST["nivel_estudios"]) ? $conn->real_escape_string($_POST["nivel_estudios"]) : '';

        $sql_select = "SELECT * FROM intereses WHERE id_usuario = $id_usuario";
        $result_select = $conn->query($sql_select);

        if ($result_select->num_rows > 0) {
            $query = "UPDATE intereses SET preferencia = '$preferencia', acerca_de_mi = '$acerca_de_mi', hobbies = '$hobbies', musica_favorita = '$musica_favorita', nivel_estudios = '$nivel_estudios' WHERE id_usuario = $id_usuario";
            if ($conn->query($query) === TRUE) {
                // echo "Datos de intereses actualizados correctamente.";
            } else {
                echo "Error al actualizar los datos de intereses: " . $conn->error;
            }
            $datos_actualizados = true;
        } else {
            $sql_insert = "INSERT INTO intereses (id_usuario, preferencia, acerca_de_mi, hobbies, musica_favorita, nivel_estudios)
                VALUES ('$id_usuario', '$preferencia', '$acerca_de_mi', '$hobbies', '$musica_favorita', '$nivel_estudios')";
            if ($conn->query($sql_insert) === TRUE) {
                // echo "Datos de intereses guardados correctamente.";
            } else {
                echo "Error al guardar los datos de intereses: " . $conn->error;
            }
        }
    }
    $datos_actualizados = isset($_GET['datos_actualizados']) ? $_GET['datos_actualizados'] : false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <link rel="stylesheet" href="assets/css/Perfil.css">
</head>
<body>
    <header>
        <div class="perfil">
            <img src="img.png">
            <br>
            <input type="file">
        </div>
    </header>
    <div class="container">
        <div class="datos">
            <label class="title"><h2>Mis datos</h2></label>
            <form method="POST" action="">
                <label for="nombre">Nombre:</label>
                <input class="input" type="text" name="nombre" value="<?php echo isset($nombreValor) ? $nombreValor : ''; ?>">
                <label for="edad">Fecha de nacimiento:</label>
                <input class="input" type="text" id="edad" name="edad" value="<?php echo isset($edadValor) ? $edadValor : ''; ?>">
                <button class="enviar">Guardar</button>
            </form>
        </div>
        <form method="POST" action="">
            <div class="intereses">
                <label class="title"><h2>Mis intereses</h2></label>
                <div class="intereses-izquierda">
                    <label for="preferencia">Busco:</label>
                    <select class="input" id="preferencia" name="preferencia" required>
                        <option value="">Género</option>
                        <option value="masculino" <?php if(isset($_POST['preferencia']) && $_POST['preferencia'] == 'masculino') echo 'selected'; ?>>Hombres</option>
                        <option value="femenino" <?php if(isset($_POST['preferencia']) && $_POST['preferencia'] == 'femenino') echo 'selected'; ?>>Mujeres</option>
                        <option value="other" <?php if(isset($_POST['preferencia']) && $_POST['preferencia'] == 'other') echo 'selected'; ?>>No tengo preferencia</option>
                    </select>
                    <label for="acerca_de_mi">Acerca de mí:</label>
                    <textarea class="text" id="acerca_de_mi" name="acerca_de_mi" rows="4"><?php if(isset($_POST['acerca_de_mi'])) echo $_POST['acerca_de_mi']; ?></textarea>
                    <label for="hobbies">Hobbies:</label>
                    <textarea class="text" id="hobbies" name="hobbies" rows="4"><?php if(isset($_POST['hobbies'])) echo $_POST['hobbies']; ?></textarea>
                </div>
                <div class="intereses-derecha">
                    <label for="musica_favorita">Música favorita:</label>
                    <textarea class="text" id="musica_favorita" name="musica_favorita" rows="4"><?php if(isset($_POST['musica_favorita'])) echo $_POST['musica_favorita']; ?></textarea>
                    <label for="nivel_estudios">Mi nivel de estudios:</label>
                    <textarea class="text" id="nivel_estudios" name="nivel_estudios" rows="4"><?php if(isset($_POST['nivel_estudios'])) echo $_POST['nivel_estudios']; ?></textarea>
                </div>
                <button class="enviar" id="interes" type="submit">Guardar</button>
            </div>
        </form>
        <div class="buscar">
            <label for="nombre">Empieza a buscar gente con intereses similares a los tuyos:</label>
            <button class="enviar" onclick="window.location.href='Busqueda.php'">Buscar</button>
        </div>
    </div>
</body>
<script>
    // Verificar si los datos se han actualizado correctamente
    var datosActualizados = "<?php echo isset($datos_actualizados) ? $datos_actualizados : '' ?>";
    if (datosActualizados) {
        alert("Los datos se han actualizado correctamente.");
    }
    const image = document.querySelector('img'),
    input = document.querySelector('input');

    input.addEventListener("change", () => {
        image.src = URL.createObjectURL(input.files[0]);
    });

</script>
</html>
