<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css"> <!--agragamos el app.css del build-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <header class="header <?php echo  $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo Bienes Raices">
                </a>
                <div class="mobile-menu">
                    <img loading="lazy" src="/build/img/barras.svg" alt="menu responsive">
                </div>
                <div class="derecha">
                    <!-- dark node -->
                     <img loading="lazy" src="/build/img/dark-mode.svg" alt="dark mode" class="dark-mode-boton">
                    <!-- Menú de navegación principal -->
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>  <!-- Enlace a la sección/página Nosotros -->
                        <a href="anuncios.php">Anuncios</a>  <!-- Enlace a la sección/página Anuncios -->
                        <a href="blog.php">Blog</a>          <!-- Enlace a la sección/página Blog -->
                        <a href="contacto.php">Contacto</a>  <!-- Enlace a la sección/página Contacto -->
                    </nav>
                </div>
                
            </div>
            <?php 
                if($inicio){
                    echo"<h1>Venta de Propiedades de Lujo</h1>";
                }
            ?>
        </div>
    </header>