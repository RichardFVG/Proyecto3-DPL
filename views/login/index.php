<!-- views/login/index.php -->
<?php include_once __DIR__ . "/../layout/header.php"; ?>

<div class="login-container">
    <!-- Inserto el ( ! ) con el tooltip justo encima del h2 -->
    <div class="tooltip">( ! )
        <span class="tooltiptext">
            Usuario1: admin, 1234<br>
            Usuario2: ana, 4321
        </span>
    </div>
    <h2 class="titulo2">Iniciar Sesión</h2>

    <div id="mensajeResultado" style="color: red; font-weight: bold;"></div>

    <form id="loginForm">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" id="btnLogin">Entrar</button>
    </form>
</div>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
