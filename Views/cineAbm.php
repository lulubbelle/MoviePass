<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/cinemaAbm.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Abm Cines -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Cine</h1>                
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Formulario Cines -->
                    <form action="<?= FRONT_ROOT ?>CineAbm/AddCine" method="POST" class="cinema-form">
                        <?php if(isset($errorCineAbm)) {?>
                            <strong style="color:red;"><?=$errorCineAbm?></strong>
                        <?php }?>
                            <div class="form-content">
                                <div class="form-group">
                                    <label class="cinema-input-label" for="capacidad">Capacidad</label>
                                    <input type="number" name="capacidad" class="form-control form-control-md cinema-input" placeholder="Capacidad" required>
                                </div>
                                <div class="form-group">
                                    <label class="cinema-input-label" for="valorEntrada">Valor Entrada</label>
                                    <input type="number" name="valorEntrada" class="form-control form-control-md cinema-input" placeholder="Valor Entrada" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="cinema-input-label" for="nombre">Nombre</label>
                                    <input type="text" name="nombre" class="form-control form-control-md cinema-input" placeholder="Nombre" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="cinema-input-label" for="direccion">Direccion</label>
                                    <input type="text" name="direccion" class="form-control form-control-md cinema-input" placeholder="Direccion" required>
                                </div>
                                
                            </div>
                        <button class="btn btn-block cinema-btn" type="submit">Crear Cine</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>