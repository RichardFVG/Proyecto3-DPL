<!-- views/productos/borrar.php -->
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<h2>Eliminar Producto</h2>
<p>¿Estás seguro de que quieres eliminar el producto <strong><?php echo $producto['nombre']; ?></strong>?</p>

<form action="../../public/index.php?controller=Productos&action=borrar" method="POST">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    <button type="submit">Eliminar</button>
    <a href="../../public/index.php?controller=Productos&action=listar">Cancelar</a>
</form>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
