<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Contraseñas</title>
</head>
<body>
    <h1>Generador de Contraseñas</h1>
    <form method="POST">
        <label for="longitud">Longitud de la contraseña:</label>
        <input type="number" id="longitud" name="longitud" min="4" max="50" value="8" required>
        <br><br>

        <label><input type="checkbox" name="tipos[]" value="letras" checked> Incluir letras</label><br>
        <label><input type="checkbox" name="tipos[]" value="numeros" checked> Incluir números</label><br>
        <label><input type="checkbox" name="tipos[]" value="especiales"> Incluir caracteres especiales</label><br><br>

        <button type="submit">Generar contraseña</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function generarContrasena($longitud, $tipos) {
            $letras = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $numeros = '0123456789';
            $especiales = '!@#$%^&*()-_=+[]{}|;:,.<>?';
            $caracteres = '';

            if (in_array('letras', $tipos)) {
                $caracteres .= $letras;
            }
            if (in_array('numeros', $tipos)) {
                $caracteres .= $numeros;
            }
            if (in_array('especiales', $tipos)) {
                $caracteres .= $especiales;
            }

            if (empty($caracteres)) {
                return 'Selecciona al menos un tipo de carácter.';
            }

            $contrasena = '';
            $max = strlen($caracteres) - 1;

            for ($i = 0; $i < $longitud; $i++) {
                $contrasena .= $caracteres[random_int(0, $max)];
            }

            return $contrasena;
        }

        $longitud = intval($_POST['longitud']);
        $tipos = $_POST['tipos'] ?? []; 

        $contrasena = generarContrasena($longitud, $tipos);

        echo "<h2>Tu contraseña generada es:</h2>";
        echo "<p><strong>$contrasena</strong></p>";
    }
    ?>
</body>
</html>
