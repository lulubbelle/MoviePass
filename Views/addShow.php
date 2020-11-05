<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/cinemaAbm.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Abm Funciones -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Agregar Funcion</h1>                
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Formulario Funciones -->
                    <?php $action;
                        isset($cinema) ? $action = "Cinema/UpdateCinema" : $action = "Cinema/AddCine";
                    ?>
                    <form action="<?= FRONT_ROOT.$action ?> " method="POST" class="cinema-form">
                        <?php if(isset($errorAbmCine)&& !empty($errorAbmCine)) {?>
                            <p class="alert alert-danger"><?=$errorAbmCine?></p>
                        <?php }?>
                        <?php if(isset($successMsg) && !empty($successMsg)) {?>
                            <p class="alert alert-success"><?=$successMsg?></p>
                        <?php }?>
                        
                            <div class="form-content">
                                <!-- Solo para vista de modificacion -->
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="id" class="form-control form-control-md cinema-input" placeholder="Id" value="<?php if(isset($cinema)) {echo $cinema->getId();} ?>">
                                </div>                                
                                <!-- Ciudades -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cityId">Ciudad</label>
                                    <select name="cityId" id="ciudad" class="form-control form-control-md cinema-input" placeholder="Ciudad">
                                    <?php
                                    foreach ($cities as $city) {
                                        //Selecciona la opcion que coincide con la ciudad del cine
                                        $selected = (isset($cinema) && $cinema->getCityId() == $city->getId()) ? " selected" : "";
                                    ?>
                                        <option value="<?= $city->getId() ?>" 
                                        <?= $selected ?>>
                                            <?= $city->getName() ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    
                                    </select>
                                </div>
                                <!-- Cines -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cityId">Ciudad</label>
                                    <select name="cityId" id="ciudad" class="form-control form-control-md cinema-input" placeholder="Ciudad">
                                    <?php
                                    foreach ($cities as $city) {
                                        //Selecciona la opcion que coincide con la ciudad del cine
                                        $selected = (isset($cinema) && $cinema->getCityId() == $city->getId()) ? " selected" : "";
                                    ?>
                                        <option value="<?= $city->getId() ?>" 
                                        <?= $selected ?>>
                                            <?= $city->getName() ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    
                                    </select>
                                </div>
                                <!-- Salas -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cityId">Ciudad</label>
                                    <select name="cityId" id="ciudad" class="form-control form-control-md cinema-input" placeholder="Ciudad">
                                    <?php
                                    foreach ($cities as $city) {
                                        //Selecciona la opcion que coincide con la ciudad del cine
                                        $selected = (isset($cinema) && $cinema->getCityId() == $city->getId()) ? " selected" : "";
                                    ?>
                                        <option value="<?= $city->getId() ?>" 
                                        <?= $selected ?>>
                                            <?= $city->getName() ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    
                                    </select>
                                </div>                                
                                
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="active" class="form-control form-control-md cinema-input" placeholder="Active" value="<?php if(isset($cinema)) {echo $cinema->getActive();} ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label class="cinema-input-label" for="name">Nombre</label>
                                    <input type="text" name="name" class="form-control form-control-md cinema-input" maxlength="<?= MAX_LENGTH_255 ?>" placeholder="Nombre" value="<?php if(isset($cinema)) {echo $cinema->getName();}?>" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="cinema-input-label" for="address">Direccion</label>
                                    <input type="text" name="address" class="form-control form-control-md cinema-input" maxlength="<?= MAX_LENGTH_255 ?>" placeholder="Direccion" value="<?php if(isset($cinema)) {echo $cinema->getAddress();}?>" required>
                                </div>                                                                                        
                            </div>
                        <button class="btn btn-block cinema-btn" type="submit"> <?php if(isset($cinema)) {echo "Actualizar Funcion";} else { echo "Crear Funcion";}?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>