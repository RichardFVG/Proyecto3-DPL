<!-- views/productos/update.php -->
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<h2>Actualizar Producto</h2>
<form action="../../public/index.php?controller=Productos&action=update" method="POST">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo $producto['descripcion']; ?></textarea>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required>

    <button type="submit">Actualizar Producto</button>
</form>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
