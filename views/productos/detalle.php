<!-- views/productos/detalle.php -->
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<h2>Detalles del Producto</h2>

<p><strong>Nombre:</strong> <?php echo $producto['nombre']; ?></p>
<p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
<p><strong>Precio:</strong> €<?php echo $producto['precio']; ?></p>

<a href="../../public/index.php?controller=Productos&action=update&id=<?php echo $producto['id']; ?>">Editar</a> |
<a href="../../public/index.php?controller=Productos&action=borrar&id=<?php echo $producto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</a>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
