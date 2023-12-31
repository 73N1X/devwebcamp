<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>
    <p class="auth__texto">Coloca tu nueva Contraseña</p>
    <?php require_once __DIR__ . '/../templates/alertas.php' ?>

    <?php if ($token_valido) { ?>
        <form class="formulario" method="POST">
            <div class="formulario__campo">
                <label for="password" class="formulario__label">Nueva Contraseña</label>
                <input type="password" class="formulario__input" placeholder="Tu Contraseña" id="password" name="password" autocomplete="new-password">
            </div>
            <input type="submit" class="formulario__submit" value="Cambiar Contraseña">
        </form>
    <?php } ?>
    <div class="acciones">
        <a href="/login" class="acciones__enlace">¿Ya tienes cuenta? Inicia Sesión!</a>
        <a href="/registro" class="acciones__enlace">¿Aún no tienes cuenta? Crea una!</a>
    </div>
</main>