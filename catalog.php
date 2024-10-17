<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Planos</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #333;
        }

        header {
            background-color: #283e4a; /* Color de fondo elegante */
            color: #fff;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .planos-categorias {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #283e4a;
        }

        .planos-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .planos-list li {
            list-style: none;
        }

        .cta-button {
            display: inline-block;
            background-color: #1e88e5;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: 1px;
            box-shadow: 0 4px 10px rgba(30, 136, 229, 0.4);
        }

        .cta-button:hover {
            background-color: #005bb5;
            transform: translateY(-5px);
        }

        footer {
            background-color: #283e4a;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        /* Responsivo */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.5rem;
            }

            .planos-categorias {
                padding: 30px;
            }

            h2 {
                font-size: 2rem;
            }

            .cta-button {
                padding: 12px 30px;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Catálogo de Planos</h1>
    </header>

    <div class="container">
        <div class="planos-categorias">
            <h2>Tipos de planos existentes:</h2>
            <ul class="planos-list">
                <li><a href="planos_oficinas.php" class="cta-button">Planos Oficinas</a></li>
                <li><a href="planos_comerciales.php" class="cta-button">Planos Comerciales</a></li>
                <li><a href="planos_residenciales.php" class="cta-button">Planos Residenciales</a></li>
            </ul>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 ArchiPlan Store - Todos los derechos reservados</p>
    </footer>

</body>
</html>
