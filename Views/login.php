<main class="d-flex align-items-center justify-content-center height-100" >
    <div class="content">
        <header class="text-center">
                <h2>Login</h2>
        </header>

        
        <form action="<?= FRONT_ROOT ?>Login/CheckLogin" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                <!-- <?php if(isset($_GET["errorLogin"])) {?>
                    <strong style="color:red;"><?=$_GET["errorLogin"]?></strong>
                <?php }?> -->
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control form-control-lg" placeholder="Ingresar username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar password" required>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión</button>
        </form>
    </div>
</main>