<?php
// Configurar la zona horaria para Cancún, Quintana Roo, México
date_default_timezone_set('America/Cancun');

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "planos");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado el ID del plano
if (!isset($_GET['id'])) {
    die("ID de plano no válido.");
}

$id_plano = intval($_GET['id']);

// Consulta para obtener detalles del plano seleccionado
$sql = "SELECT * FROM Planos_Oficinas WHERE id_plano = $id_plano";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (!$row) {
    die("Plano no encontrado.");
}

// Variables para el costo y tipo de plano
$nombre_plano = htmlspecialchars($row['nombre']);
$precio_plano = $row['precio'];

// Lógica para manejar la compra
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre_usuario = htmlspecialchars($_POST['nombre']);
    $tipo_plano = htmlspecialchars($_POST['tipo_plano']);
    $monto_pagado = floatval($_POST['monto_pagado']);
    $cambio = $monto_pagado - $precio_plano;

    // Guardar la compra en el historial
    $insert_sql = "INSERT INTO Historial_Compras (nombre_usuario, tipo_plano, precio_plano, monto_pagado, cambio, fecha_hora) 
                   VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssddd", $nombre_usuario, $tipo_plano, $precio_plano, $monto_pagado, $cambio);

    if ($stmt->execute()) {
        echo "<p class='success-message'>Compra realizada con éxito.</p>";
    } else {
        echo "<p class='error-message'>Error al guardar la compra: " . $conn->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Plano - <?php echo $nombre_plano; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.6;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            font-size: 1.8rem;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #495057;
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        label {
            font-weight: 500;
            color: #495057;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            color: #495057;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .summary {
            margin-top: 30px;
            padding: 15px;
            background-color: #e9f5ff;
            border-left: 5px solid #007bff;
            border-radius: 5px;
            font-size: 1.1rem;
        }

        .summary strong {
            color: #007bff;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
            width: 100%;
        }

        .btn:hover {
            background-color: #0056b3;
            box-shadow: 0 8px 15px rgba(0, 91, 187, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 12px;
            text-align: center;
            font-size: 1rem;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        td {
            background-color: #f8f9fa;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: #fff;
            margin-top: 50px;
            font-size: 0.9rem;
        }

        .cambio-container {
            margin-top: 10px;
            font-size: 1.1rem;
            color: #28a745;
        }

        .error-message {
            color: #e74c3c;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 1.6rem;
            }

            .btn {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Pagar Plano</h1>
    </header>

    <div class="container">
        <h2>Detalles de Compra</h2>
        <label for="tipo_plano">Tipo de Plano:</label>
        <input type="text" id="tipo_plano" name="tipo_plano" value="<?php echo $nombre_plano; ?>" readonly>

        <p class="summary"><strong>Precio:</strong> $<?php echo number_format($precio_plano, 2); ?></p>

        <form method="POST">
            <label for="nombre">Nombre del Usuario:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="monto_pagado">Monto a Pagar:</label>
            <input type="number" id="monto_pagado" name="monto_pagado" step="0.01" required>

            <div class="cambio-container">
                <p><strong>Cambio:</strong> <span id="cambio">0.00</span></p>
            </div>

            <p><strong>Fecha y Hora:</strong> <?php echo date('d-m-Y H:i:s'); ?></p>

            <button type="submit" class="btn">Finalizar Compra</button>
        </form>

        <a href="planos_oficinas.php" class="btn" style="margin-top: 20px;">Atrás</a>

        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <h2>Resumen de la Compra</h2>
            <table>
                <tr>
                    <th>Nombre del Usuario</th>
                    <th>Monto Pagado</th>
                    <th>Precio del Plano</th>
                    <th>Cambio</th>
                    <th>Fecha y Hora de la compra</th>
                </tr>
                <tr>
                    <td><?php echo $nombre_usuario; ?></td>
                    <td>$<?php echo number_format($monto_pagado, 2); ?></td>
                    <td>$<?php echo number_format($precio_plano, 2); ?></td>
                    <td>$<?php echo number_format($cambio, 2); ?></td>
                    <td><?php echo date('d-m-Y H:i:s'); ?></td>
                </tr>
            </table>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; 2024 Tu Empresa de Planos | Todos los derechos reservados.</p>
    </footer>

    <script>
        document.getElementById('monto_pagado').addEventListener('input', function() {
            const montoPagado = parseFloat(this.value) || 0;
            const precioPlano = parseFloat(<?php echo $precio_plano; ?>);
            const cambio = montoPagado - precioPlano;
            document.getElementById('cambio').innerText = cambio.toFixed(2);
        });
    </script>
</body>
</html>
