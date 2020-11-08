<?php require_once(VIEWS_PATH."nav.php"); ?>
<link rel="stylesheet" href="<?= CSS_PATH ?>/cinemaAbm.css">


<body>
    <div class="container">
        <!-- Inicio Index -->
        <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Mis Datos</h1>                
                </div>
            <!-- form -->
            <div class="col-md-12">
                <div class="form-profile">

                    <form  action="<?php echo FRONT_ROOT ?>Profile/UpdateUser" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="cinema-input-label" for="inputEmail">Email</label>
                                <input type="email" class="form-control" value="<?php echo ($profile->getMail()) ?>" id="inputEmail" placeholder="Email" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="cinema-input-label" for="inputNombre"><i style="color: red;">&#42&nbsp</i>Nombre de Usuario</label>
                                <input type="text" name="user_name" value="<?php echo ($profile->getUserName()) ?>" class="form-control" id="inputNombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="cinema-input-label" for="inputNombre"><i style="color: red;">&#42&nbsp</i>Nombre</label>
                                <input type="text" name="first_name" value="<?php echo ($profile->getFirstName()) ?>" class="form-control" id="inputNombre" placeholder="Nombre" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="cinema-input-label" for="inputNombre"><i style="color: red;">&#42&nbsp</i>Apellido</label>
                                <input type="text" name="last_name" value="<?php echo ($profile->getLastName()) ?>" class="form-control" id="inputNombre" placeholder="Apellido" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="cinema-input-label" for="inputNombre"><i style="color: red;">&#42&nbsp</i>DNI</label>
                                <input type="text" name="dni" value="<?php echo ($profile->getDNI()) ?>" class="form-control" id="inputNombre" placeholder="DNI" required>
                            </div>
                            <div class="form-group col-md-6" style="display:none">
                                <input type="text" name="user_id" value="<?php echo ($profile->getUserId()) ?>" class="form-control" id="inputId" placeholder="Id" required>
                            </div>
                            <div class="form-group col-md-6" style="display:none">
                                <input type="text" name="user_profile_id" value="<?php echo ($profile->getId()) ?>" class="form-control" id="upId" placeholder="upId" required>
                            </div>
                        </div>
                                                                        
                        <button type="submit" class="btn btn-block cinema-btn"><i class="fas fa-save"></i>&nbspGuardar cambios</button>
                        <a href="<?php echo FRONT_ROOT ?>Profile/" class="btn btn-primary btn-volver"><i class="fas fa-arrow-left"></i>&nbspVolver</a>
                    </form>
                </div>
                <!-- form -->
            </div>
        </div>
        <!-- Fin Index -->
    </div>


</body>

</html>

<style>
    .form-profile {
        margin: 0 auto;
        width: 70%;
    }

    .btn-volver {
        margin-bottom: 10%;
    }
</style>