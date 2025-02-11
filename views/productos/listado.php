<!-- views/productos/listado.php -->
<?php
// Incluir la cabecera general (HTML base y menú)
include_once __DIR__ . "/../layout/header.php";

// Mostramos el nombre del usuario con el estilo que ya existía
?>
<p style="background-color: #000000; color: #39FF14; border: 4px solid #ffbf00; border-radius: 10px; padding: 10px;">
    <strong>Bienvenido, <?php echo $_SESSION['usuario']; ?></strong>
</p>

<h2>Listado de Productos</h2>

<?php
/**
 * Función para "pintar" las estrellas dada una media de valoración.
 * - 5 estrellas totales
 * - Si la parte decimal >= 0.5 => 1 media estrella
 * - El resto, estrellas vacías
 */
function pintarEstrellas($media) {
    // Convierto a float por si llega como string
    $valor = floatval($media);

    // Número de estrellas completas
    $estrellasCompletas = floor($valor);

    // Decimales
    $parteDecimal = $valor - $estrellasCompletas;

    // Determino si hay media estrella
    $hayMediaEstrella = ($parteDecimal >= 0.5) ? 1 : 0;

    // El resto serán estrellas vacías
    $estrellasVacias = 5 - $estrellasCompletas - $hayMediaEstrella;
    
    // Construyo el HTML
    $html = "";
    
    // Pinto las estrellas completas
    for ($i = 0; $i < $estrellasCompletas; $i++) {
        $html .= '<i class="fas fa-star" style="color:#ffc107;"></i>';
        // Color dorado (#ffc107)
    }

    // Pinto la media estrella (si procede)
    if ($hayMediaEstrella) {
        // Para FA 6.x se usa "fa-star-half-stroke"
        $html .= '<i class="fas fa-star-half-stroke" style="color:#ffc107;"></i>';
        // Para FA 5.x: "fas fa-star-half-alt"
    }

    // Pinto las estrellas vacías
    for ($j = 0; $j < $estrellasVacias; $j++) {
        $html .= '<i class="far fa-star" style="color:#ffc107;"></i>';
    }
    
    return $html;
}
?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Valoración</th> <!-- Aquí solo estrellas y media -->
        <th>Acciones</th>
    </tr>

    <?php
    // Verifico que la variable $productos esté disponible
    if (isset($productos)) {
        foreach ($productos as $producto) {
            // Obtengo la media (ej. 4.3, 5.0, 3.5, etc.)
            $media = $producto['media'];

            // Si no hay valoraciones, tu variable era 'N/A', la fuerzo a 0
            if ($media === 'N/A') {
                $media = 0;
            }
            ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td>€<?php echo $producto['precio']; ?></td>
                
                <td>
                    <?php
                    // Pinto las estrellas según la media
                    echo pintarEstrellas($media);
                    
                    // Muestro la media numérica en paréntesis (p.ej. "(3.5/5)")
                    // Siempre la muestro, aunque sea 0
                    echo ' <span style="color:#666;">(' . round($media, 2) . '/5)</span>';
                    ?>
                </td>
                
                <td>
                    <a href="../../public/index.php?controller=Productos&action=detalle&id=<?php echo $producto['id']; ?>">Ver</a>
                    <a href="../../public/index.php?controller=Productos&action=update&id=<?php echo $producto['id']; ?>">Editar</a>
                    <a href="../../public/index.php?controller=Productos&action=borrar&id=<?php echo $producto['id']; ?>"
                       onclick="return confirm('¿Estás seguro?')">Borrar</a>
                </td>
            </tr>
        <?php
        }
    } else {
        echo "<tr><td colspan='6'>No hay productos disponibles.</td></tr>";
    }
    ?>
</table>

<p>
    <a href="../../public/index.php?controller=Productos&action=crear">Crear nuevo producto</a>
</p>

<?php
// cierre de etiquetas y scripts
include_once __DIR__ . "/../layout/footer.php";
