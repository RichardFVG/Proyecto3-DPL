<!-- views/productos/crear.php -->
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<h2>Crear Producto</h2>
<form action="../../public/index.php?controller=Productos&action=crear" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required>

    <button type="submit">Crear Producto</button>
</form>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
