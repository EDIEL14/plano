<?php
// Configura la zona horaria a Cancún, Quintana Roo, México
date_default_timezone_set('America/Cancun');

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "planos");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se recibió el id_plano
if (isset($_GET['id_plano'])) {
    $id_plano = intval($_GET['id_plano']);

    // Consulta para obtener los detalles del plano
    $sql = "SELECT * FROM Planos_Residenciales WHERE id_planos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_plano);
    $stmt->execute();
    $result = $stmt->get_result();
    $plano = $result->fetch_assoc();
    if (!$plano) {
        die("Plano no encontrado.");
    }
} else {
    die("ID de plano no proporcionado.");
}

$cambio = ""; // Inicializa la variable cambio
$compra_exitosa = false; // Variable para verificar si la compra fue exitosa

// Si el formulario de compra es enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $monto_pagado = floatval($_POST['monto_pagado']);
    $precio_plano = floatval($plano['precio']);
    $cambio = $monto_pagado - $precio_plano;
    $fecha_hora = date("Y-m-d H:i:s"); // Fecha y hora actual en tiempo de Cancún

    // Insertar en la tabla Historial_Compras
    $sql = "INSERT INTO Historial_Compras (nombre_usuario, tipo_plano, precio_plano, monto_pagado, cambio, fecha_hora) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddds", $nombre_usuario, $plano['nombre'], $precio_plano, $monto_pagado, $cambio, $fecha_hora);

    if ($stmt->execute()) {
        $compra_exitosa = true; // Establecer a verdadero si la compra fue exitosa
    } else {
        echo "<div class='error'>Error al procesar la compra: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Plano</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #e0e0e0, #f7f7f7);
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 16px;
            max-width: 800px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.1);
            display: flex; /* Cambiado a flex */
        }

        .form-container,
        .details-container {
            flex: 1; /* Cada columna ocupa el mismo espacio */
            padding: 20px;
        }

        .form-container {
            border-right: 1px solid #dcdcdc; /* Divisor entre columnas */
        }

        h1 {
            font-size: 30px;
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        h2 {
            font-size: 22px;
            color: #34495e;
            margin-bottom: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        label {
            font-size: 14px;
            font-weight: 500;
            display: block;
            text-align: left;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #dcdcdc;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #2980b9;
        }

        button {
            width: 100%;
            padding: 14px 0;
            background-color: #2980b9;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3498db;
            transform: translateY(-2px);
        }

        button:active {
            transform: translateY(0);
        }

        .success {
            background-color: #e3f6f1;
            border: 1px solid #b5e2d6;
            color: #2e8b7d;
            padding: 20px;
            border-radius: 12px;
            margin-top: 30px;
            text-align: left;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease;
        }

        .success h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .success ul {
            list-style-type: none;
            padding: 0;
        }

        .success ul li {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .success ul li strong {
            color: #2c3e50;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function calcularCambio() {
            const montoPlano = parseFloat(document.getElementById("precio_plano").value.replace(/[$,]/g, ""));
            const montoPagado = parseFloat(document.getElementById("monto_pagado").value) || 0;
            const cambio = montoPagado - montoPlano;

            document.getElementById("cambio").value = cambio >= 0 ? '$' + cambio.toFixed(2) : 'Monto insuficiente';
        }
    </script>
</head>

<body>
    <div class="container">
        <!-- Columna para el formulario de compra -->
        <div class="form-container">
            <h1>Pagar Plano</h1>

            <!-- Formulario de compra -->
            <form method="post">
                <h2>Detalles de la Compra</h2>

                <label for="tipo_plano">Nombre del Plano:</label>
                <input type="text" id="tipo_plano" value="<?php echo $plano['nombre']; ?>" disabled>

                <label for="precio_plano">Monto del Plano:</label>
                <input type="text" id="precio_plano" value="$<?php echo number_format($plano['precio'], 2); ?>" disabled>

                <label for="nombre_usuario">Nombre del Usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>

                <label for="monto_pagado">Monto Pagado:</label>
                <input type="number" id="monto_pagado" name="monto_pagado" step="0.01" required oninput="calcularCambio()">

                <label for="cambio">Cambio:</label>
                <input type="text" id="cambio" disabled>

                <button type="submit">Finalizar Compra</button>
            </form>
        </div>

        <!-- Columna para los detalles del plano -->
        <div class="details-container">
            <h2>Detalles del Plano</h2>
            <p><strong>Habitaciones:</strong> 3</p>
            <p><strong>Niveles:</strong> 1</p>
            <p><strong>Tamaño:</strong> 200 m²</p>
            <p><strong>Vehículos permitidos:</strong> 2</p>
        </div>
    </div>

    <!-- Mensaje de compra exitosa -->
    <?php if ($compra_exitosa): ?>
        <div class="success">
            <h2>Compra Exitosa!</h2>
            <ul>
                <li><strong>Nombre del Usuario:</strong> <?php echo htmlspecialchars($nombre_usuario); ?></li>
                <li><strong>Tipo de Plano:</strong> <?php echo htmlspecialchars($plano['nombre']); ?></li>
                <li><strong>Precio del Plano:</strong> $<?php echo number_format($precio_plano, 2); ?></li>
                <li><strong>Monto Pagado:</strong> $<?php echo number_format($monto_pagado, 2); ?></li>
                <li><strong>Cambio:</strong> $<?php echo number_format($cambio, 2); ?></li>
                <li><strong>Fecha y Hora:</strong> <?php echo $fecha_hora; ?></li>
            </ul>
        </div>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>

</html>
