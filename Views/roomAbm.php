<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/cinemaAbm.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Abm Sala -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Sala</h1>                
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Formulario Sala -->
                    <?php $action;
                        isset($room) ? $action = "Cinema/UpdateRoom" : $action = "Cinema/AddRoom";
                    ?>
                    <form action="<?= FRONT_ROOT.$action ?> " method="POST" class="cinema-form">
                        <?php if(isset($errorAbmRoom)) {?>
                            <p class="alert alert-danger"><?=$errorAbmRoom?></p>
                        <?php }?>
                        <?php if(isset($successMsg)) {?>
                            <p class="alert alert-success"><?=$successMsg?></p>
                        <?php }?>
                        
                            <div class="form-content">
                                <!-- Solo para vista de modificacion -->
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="id" class="form-control form-control-md cinema-input" placeholder="id" value="<?php if(isset($room)) {echo $room->getId();} ?>">
                                </div>
                                <div class="form-group">
                                    <label class="cinema-input-label" for="name">Nombre</label>
                                    <input type="text" name="name" class="form-control form-control-md cinema-input" placeholder="Nombre" value="<?php if(isset($room)) {echo $room->getName();}?>" required>
                                </div>
                                <div class="form-group">
                                    <label class="cinema-input-label" for="capacity">Capacidad</label>
                                    <input type="number" name="capacity" class="form-control form-control-md cinema-input" placeholder="Capacidad" value="<?php if(isset($room)) {echo $room->getCapacity();} ?>" required>
                                </div>    
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="cinemaId" class="form-control form-control-md cinema-input" placeholder="cinemaId" value="<?php if(isset($room)) {echo $room->getCinemaId();}else { echo $cineId; } ?>">
                                </div>                                                           
                            </div>                            
                        <button class="btn btn-block cinema-btn" type="submit"> <?php if(isset($room)) {echo "Actualizar Sala";} else { echo "Crear Sala";}?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>