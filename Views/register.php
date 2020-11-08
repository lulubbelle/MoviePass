<link rel="stylesheet" href="<?= CSS_PATH ?>/register.css">

<main class="d-flex align-items-center justify-content-center height-100" >
    <div class="login-content">
        <div class="login-logo text-center">
                <img src="<?= IMG_PATH ?>/logo.png" alt="MoviePass Logo" width="114px" height="116px"/>
                <h2 id="login-title">MoviePass</h2>
        </div>

        
        <form action="<?= FRONT_ROOT ?>Register/RegisterUser" method="POST" class="login-form">
                <!-- Error en registro -->
                <?php if(isset($registerErrors)) {?>
                    <p class="alert alert-danger ml-5 mr-5"><?=$registerErrors?></p>
                <?php }?>

                <div class="form-content">
                    <div class="form-group">
                        <label class="login-input-label" for="email">Email</label>
                        <input type="text" name="email" class="form-control form-control-md login-input" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="firstName">Nombre</label>
                        <input type="text" name="first_name" class="form-control form-control-md login-input" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="lastName">Apellido</label>
                        <input type="text" name="last_name" class="form-control form-control-md login-input" placeholder="Apellido" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="dni">DNI</label>
                        <input type="number" name="dni" class="form-control form-control-md login-input" placeholder="Dni" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="login-input-label" for="username">Nombre de Usuario</label>
                        <input type="text" name="username" class="form-control form-control-md login-input" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="password">Contraseña</label>
                        <input type="password" name="password" class="form-control form-control-md login-input" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label class="login-input-label" for="confirmpassword">Confirmar contraseña</label>
                        <input type="password" name="confirmpassword" class="form-control form-control-md login-input" placeholder="Confirmar Contraseña" required>
                    </div>
                </div>
                <button class="login-btn" type="submit">Registrarse</button>
                <div class="register-link-container">
                    <a class="register-link" href="<?= FRONT_ROOT ?>Login/Index">Iniciar Sesion</a>
                </div> 
        </form>
    </div>
</main>