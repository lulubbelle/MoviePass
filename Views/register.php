<main class="d-flex align-items-center justify-content-center height-100" >
    <div class="content">
        <header class="text-center">
                <h2>Register</h2>
        </header>

        
        <form action="<?= FRONT_ROOT ?>Register/RegisterUser" method="POST" class="login-form bg-dark-alpha p-5 bg-light">
                
                <!-- Error en registro -->
                <?php if(isset($registerErrors)) {?>
                    <strong style="color:red;"><?=$registerErrors?></strong>
                <?php }?>

                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" name="mail" class="form-control form-control-lg" placeholder="Ingresar email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Ingresar password" required>
                </div>
                <button class="btn btn-primary btn-block btn-lg" type="submit">Registrarme</button>
                
        </form>
    </div>
</main>
