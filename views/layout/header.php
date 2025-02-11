<!-- views/layout/header.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <!-- Añado la meta etiqueta para una mejor respuesta en móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFVG: Valoración con Estrellas</title>
    
    <!-- Hoja de estilos principal -->
    <link rel="stylesheet" href="../../public/css/estilos.css">
    
    <!-- Cargo Font Awesome/librería de iconos -->
    <!-- CDN de FA 6.x -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <h1 class="titulo1">Proyecto UT6: Valoración con Estrellas</h1>
        <nav>
            <!-- Menú de navegación -->
            <a href="../../public/index.php?controller=Productos&action=listar">Productos |</a>
            <a href="../../public/index.php?controller=Login&action=logout">| Cerrar sesión</a>
        </nav>
    </header>
    <main>
