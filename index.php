<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Planos Arquitectónicos</title>
    <link rel="stylesheet" href="styles.css"> <!-- Puedes enlazar tu archivo CSS aquí -->
    <style>
        /* Estilos para el diseño de la página */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #007bff; /* Color de fondo del encabezado */
            color: white;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline; /* Efecto hover en los enlaces del menú */
        }

        /* Sección de hero y carrusel */
        .hero-reel-container {
            position: relative;
            height: 400px;
        }

        /* Carrusel de imágenes tipo Reels */
        .reel-container {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            border-radius: 0; /* Sin bordes redondeados ya que ocupará todo el espacio */
        }

        .reel-images {
            display: flex;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .reel-images img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .reel-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }

        .reel-nav button {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-size: 20px;
        }

        /* Hero Content */
        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6); /* Fondo semitransparente */
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            color: white;
        }

        .cta-button {
            background-color: #007BFF; /* Color de fondo */
            color: white; /* Color del texto */
            padding: 10px 20px; /* Espaciado interno */
            border-radius: 5px; /* Bordes redondeados */
            text-decoration: none; /* Sin subrayado */
            display: inline-block; /* Para que se comporte como un bloque */
        }

        .cta-button:hover {
            background-color: #0056b3; /* Color al pasar el mouse */
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .hero-reel-container {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenido <?php echo htmlspecialchars($_SESSION['usuario']); ?> a ArchiPlan Store</h1>
        <nav>
            <a href="index.php"><span class="symbol">🏡</span> Inicio</a>
            <a href="forPago.php"><span class="symbol">💵</span> Formas de Pago</a>
            <a href="about.php"><span class="symbol">ℹ️</span> Sobre Nosotros</a>
            <a href="contact.php"><span class="symbol">📞</span> Contacto</a>
            <a href="logout.php"><span class="symbol">🚪</span> Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <!-- Sección combinada del carrusel y hero content -->
        <div class="hero-reel-container">
            <!-- Carrusel tipo reels -->
            <div class="reel-container">
                <div class="reel-images" id="reel-images">
                    <img src="https://www.construyehogar.com/wp-content/uploads/2013/11/Dise25C325B1odeminidepartamento3dmdigital-1.jpg" loading="lazy" alt="Plano 1">
                    <img src="https://th.bing.com/th/id/OIP.sPrJwnBQl2clqoyVFYlQ4QHaCx?rs=1&pid=ImgDetMain" alt="Plano 2">
                    <img src="https://i.pinimg.com/originals/b5/9f/76/b59f7693254b355ac50bfd209d745e0e.jpg" alt="Plano 3">
                    <img src="https://th.bing.com/th/id/R.c32bf8df4dc5b37e743c78eb79a6e3e8?rik=epVoEU2MSZCdww&pid=ImgRaw&r=0" alt="Plano 4">
                    <img src="https://th.bing.com/th/id/OIP.UqhUrbojj1K6ct03MwIP9AHaEK?rs=1&pid=ImgDetMain" alt="Plano 5">
                    <img src="https://th.bing.com/th/id/R.e97a898b0cf5daa72cfcac88b088d89f?rik=bfwZbVyUdyrD3w&pid=ImgRaw&r=0" alt="Plano 6">
                    <img src="https://i.pinimg.com/originals/78/7d/54/787d546207a32e051908a8c5380e5c80.jpg" alt="Plano 7">
                    <img src="https://i.pinimg.com/originals/83/78/c9/8378c909517bb6e0541d86ad4c535695.jpg" alt="Plano 8">
                    <img src="https://th.bing.com/th/id/OIP.wZ0M4S2Dzn5ShhV7EkJBCAHaFj?rs=1&pid=ImgDetMain" alt="Plano 9">
                    <img src="https://th.bing.com/th/id/OIP.QyuGRTyQ-OFjq6ZHFOiEzAHaEK?rs=1&pid=ImgDetMain" alt="Plano 10">
                    <img src="https://th.bing.com/th/id/OIP.z75qL0_AIArEPJkKB6W-UwAAAA?rs=1&pid=ImgDetMain" alt="Plano 11">
                    <img src="https://i.ytimg.com/vi/bF7aJsM6C2A/hqdefault.jpg" alt="Plano 12">
                    <img src="https://i.pinimg.com/736x/51/89/02/518902bef94329b580667e95d9011ed6.jpg" alt="Plano 13">
                    <img src="https://i.ytimg.com/vi/xEZSTsz8Ywg/maxresdefault.jpg" alt="Plano 14">
                    <img src="https://th.bing.com/th/id/R.876047a5e3fc891d7f1a0ad7a7d1400b?rik=5TOWy5Pws64irg&pid=ImgRaw&r=0" alt="Plano 15">
                    <img src="https://th.bing.com/th/id/R.06fd43c52165ede4c91f483da4137476?rik=ZQlwiUjPS3fbtQ&pid=ImgRaw&r=0" alt="Plano 16">
                    <img src="https://i.pinimg.com/originals/66/3b/23/663b23f5e5a5e39558ba1a64a4601b35.jpg" alt="Plano 17">
                    <img src="https://i.pinimg.com/originals/a8/5b/84/a85b8454cecb2ea3c44f8237b27bae1b.jpg" alt="Plano 18">
                    <img src="https://i.ytimg.com/vi/RsIcmIm88N0/maxresdefault.jpg" alt="Plano 19">
                    <img src="https://th.bing.com/th/id/OIP.tG76AsdlnaYA3j4MS9j1zQHaEK?rs=1&pid=ImgDetMain" alt="Plano 20">
                    <img src="https://th.bing.com/th/id/OIP.W9vuf_rY1ohNYw3L7t5EuwAAAA?rs=1&pid=ImgDetMain" alt="Plano 21">
                    <img src="https://i.pinimg.com/736x/54/5e/f0/545ef019cbf720050b606e71d187ce6c.jpg" alt="Plano 22">
                    <img src="https://i.pinimg.com/originals/2a/03/1b/2a031bd04281c4f82d23a7a021dcc263.jpg" alt="Plano 23">
                    <img src="https://th.bing.com/th/id/OIP.ISNPz8kOWfvh1ixFwlLPcAHaFj?rs=1&pid=ImgDetMain" alt="Plano 24">
                    <img src="https://th.bing.com/th/id/R.b99ca1c74165a3164b220c171ec3901f?rik=7ZEPFz19OLByQw&pid=ImgRaw&r=0" alt="Plano 25">
                    <img src="https://th.bing.com/th/id/OIP.6KH18e4gF8Mw-qQ9F6IeUwHaFk?rs=1&pid=ImgDetMain" alt="Plano 26">
                    <img src="https://th.bing.com/th/id/OIP.ARi6LKCEb6VnTAc4dn78GQHaFj?pid=ImgDet&w=184&h=138&c=7&dpr=1.3" alt="Plano 27">
                    <img src="https://th.bing.com/th/id/OIP.bvYU_tFVkLIf852xoK-RhwHaFE?pid=ImgDet&w=184&h=126&c=7&dpr=1.3" alt="Plano 28">
                    <img src="https://th.bing.com/th/id/OIP.PGYS5w6bz5OQItQWnCJkNwHaEK?w=299&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Plano 29">
                    <img src="https://th.bing.com/th/id/OIP.KH9JLY5EK1lwQyZpYjA1UgAAAA?w=474&h=237&rs=1&pid=ImgDetMain" alt="Plano 30">
                    <img src="https://th.bing.com/th/id/OIP.MDFOSy-Qeh1MhaytBB-FNwHaEo?pid=ImgDet&w=184&h=115&c=7&dpr=1.3" alt="Plano 31">
                    <img src="https://th.bing.com/th/id/OIP.XuLHpA2goXqxZiK3k8wr0gHaE7?pid=ImgDet&w=184&h=122&c=7&dpr=1.3" alt="Plano 32">
                    <img src="https://th.bing.com/th/id/OIP.nzNCleDfCbAbGvTygOKtxgHaFh?pid=ImgDet&w=184&h=137&c=7&dpr=1.3" alt="Plano 33">
                    <img src="https://th.bing.com/th/id/OIP.Xabx6E2fS0elKXEF6Nv3fgHaEi?pid=ImgDet&w=184&h=113&c=7&dpr=1.3" alt="Plano 34">
                    <img src="https://th.bing.com/th/id/OIP.mEPTsLz4-TMrEvAN923zOAHaF8?pid=ImgDet&w=184&h=147&c=7&dpr=1.3" alt="Plano 35">
                    <img src="https://th.bing.com/th/id/OIP.wQ1HkNDTTiy3Z-xjrSwwyAHaEK?pid=ImgDet&w=184&h=103&c=7&dpr=1.3" alt="Plano 36">
                    <img src="https://th.bing.com/th/id/OIP.MV0cDCNyErktbBbogNiKqgHaEK?pid=ImgDet&w=184&h=103&c=7&dpr=1.3" alt="Plano 37">
                    <img src="https://th.bing.com/th/id/R.d0a40014ec3bbb726989bc65691e6a8e?rik=qSRIpzGVXZcHeQ&riu=http%3a%2f%2fcebuhomeph.weebly.com%2fuploads%2f2%2f0%2f9%2f6%2f20966238%2f23432511-1086383064832262-728953926-o_1_orig.png&ehk=4pibTBYK3zS5ejrlubfYk1cZy%2bt57ok3%2bC%2bJDb7HUEU%3d&risl=&pid=ImgRaw&r=0" alt="Plano 38">
                    <img src="https://th.bing.com/th/id/OIP.U7H2co14bsLM8oKj13aeyAAAAA?pid=ImgDet&w=184&h=103&c=7&dpr=1.3" alt="Plano 39">
                    <img src="https://th.bing.com/th/id/OIP.zQmqST85pPmaK5OkzJVuwAHaEK?pid=ImgDet&w=184&h=103&c=7&dpr=1.3" alt="Plano 40">
                </div>
                <div class="reel-nav">
                    <button id="prev" onclick="moveReel(-1)">&#10094;</button>
                    <button id="next" onclick="moveReel(1)">&#10095;</button>
                </div>
            </div>

            <!-- Contenido hero -->
            <div class="hero-content">
                <h2>Planos Arquitectónicos para Todo Tipo de Proyectos</h2>
                <p>Explora nuestra selección de planos arquitectónicos profesionales para proyectos residenciales, comerciales y más.</p>
                <a href="catalog.php" class="cta-button">👁️ Ver Planos</a>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 ArchiPlan Store - Todos los derechos reservados</p>
    </footer>

    <script>
        let currentIndex = 0;

        function moveReel(direction) {
            const images = document.getElementById('reel-images');
            const totalImages = images.children.length;
            currentIndex = (currentIndex + direction + totalImages) % totalImages;
            images.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        // Cambiar imágenes automáticamente cada 5 segundos
        setInterval(() => {
            moveReel(1);
        }, 5000);
    </script>
</body>
</html>
