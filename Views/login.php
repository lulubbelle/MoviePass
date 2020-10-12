<link rel="stylesheet" href="<?= CSS_PATH ?>/login.css">

<main class="d-flex align-items-center justify-content-center height-100" >
    <div class="login-content">
        <div class="login-logo text-center">
                <img src="<?= IMG_PATH ?>/logo.png" alt="MoviePass Logo" width="114px" height="116px"/>
                <h2 id="login-title">MoviePass</h2>
        </div>

        
        <form action="<?= FRONT_ROOT ?>Login/CheckLogin" method="POST" class="login-form">
                <!-- <?php if(isset($_GET["errorLogin"])) {?>
                    <strong style="color:red;"><?=$_GET["errorLogin"]?></strong>
                <?php }?> -->
                <div class="form-content">
                    <div class="form-group">
                        <label class="login-input-label" for="username">Email</label>
                        <input type="text" name="username" class="form-control form-control-md login-input" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-md login-input" placeholder="Contraseña" required>
                    </div>
                </div>
                <button class="login-btn" type="submit">Iniciar Sesión</button>
        </form>
    </div>
</main>