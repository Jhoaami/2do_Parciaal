<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuesta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="respuesta-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $pregunta = $_POST['pregunta'];

            if (strpos($pregunta, '?') !== false) {
                $apiUrl = "https://yesno.wtf/api";
                $response = file_get_contents($apiUrl);

                if ($response !== false) {
                    $data = json_decode($response, true);

                    if (isset($data['answer']) && isset($data['image'])) {
                        $respuesta = ucfirst($data['answer']);
                        $gifUrl = $data['image'];

                        echo "<h2>Respuesta: $respuesta</h2>";
                        echo "<div class='gif-container'><img src='$gifUrl' alt='GIF de respuesta'></div>";
                    } else {
                        echo "<p>Error: No se pudo obtener una respuesta válida de la API.</p>";
                    }
                } else {
                    echo "<p>Error: No se pudo conectar con la API.</p>";
                }
            } else {
                echo "<p>Respuesta: No. Debes hacer una pregunta con un signo de interrogación.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
