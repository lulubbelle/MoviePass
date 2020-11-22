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
            <div class="row movie-header-row">
                <div class="col-md-10 movie-header">
        <!--<div class="row cinema-header-row">
                <div class="col-md-10 cinema-header"> -->
                    Pelicula: <?= $movie->getTitle()?>
                    <br>
                    Descripción: <?= $movie->getDescription()?>
                    
                </div>
                <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                            <img src= "<?= IMG_LINK_W500 . $movie->getImgLink()?>" alt="Avatar" style="width:100%;height:100%;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Formulario Funciones -->
                    <?php $action = "Show/AddShow";
                        // isset($cinema) ? $action = "Cinema/UpdateCinema" : $action = "Cinema/AddCine";

                    ?>
                    <form action="<?= FRONT_ROOT.$action ?> " method="POST" class="cinema-form">
                        <?php if(isset($errorAbmShow)&& !empty($errorAbmShow)) {?>
                            <div class="alert alert-danger" style="margin-top: 15px;"><?=$errorAbmShow?></div>
                        <?php }?>
                        <?php if(isset($successMsg) && !empty($successMsg)) {?>
                            <p class="alert alert-success"><?=$successMsg?></p>
                        <?php }?>
                        
                            <div class="form-content">
                                
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="movieId" class="form-control form-control-md cinema-input" placeholder="movieId" value="<?php if(isset($movie)) {echo $movie->getId();} ?>">
                                </div>         
                                
                                <div class="form-group" style="display:none;">
                                    <input type="number" name="movieDuration" class="form-control form-control-md cinema-input" placeholder="movieDuration" value="<?php if(isset($movie)) {echo $movie->getDuration();} ?>">
                                </div>                            
                                <!-- Ciudades -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cityId">Ciudad</label>
                                    <select name="cityId" id="comboCity" class="form-control form-control-md cinema-input" placeholder="Ciudad" required>
                                    <option value="" selected> Seleccione uno... </option>
                                    <?php
                                    foreach ($cities as $city) {
                                    ?>
                                        <option value="<?= $city->getId() ?>">
                                            <?= $city->getName() ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                    
                                    </select>
                                </div>
                                <!-- Cines -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cineId">Cine</label>
                                    <select name="cinemaId" id="comboCinema" class="form-control form-control-md cinema-input" placeholder="Cine" required> </select>
                                    
                                </div>
                                <!-- Salas -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="salaId">Sala</label>
                                    <select name="roomId" id="comboRoom" class="form-control form-control-md cinema-input" placeholder="Sala" required> </select>
                                </div>                                
                                
                                <!-- Fecha -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="dateTimeFrom">Fecha / Hora</label>
                                    <input name="dateTimeFrom" id="timeSelector" type="datetime-local" min="<?php echo date("Y-m-d")?>T00:00" class="form-control form-control-md cinema-input" placeholder="Fecha / Hora" required />
                                </div>                                
                                
                            </div>
                        <button class="btn btn-block cinema-btn" type="submit"> <?php if(isset($cinema)) {echo "Actualizar Funcion";} else { echo "Crear Funcion";}?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    const disableItemById = (id) => $('#' + id).prop('disabled', true);
                                
    const validateNullResponse = (data) => data != '' && data != '[]';

    $(function(){
        disableItemById('comboCinema');
        disableItemById('comboRoom');
    });

    const getCinemas = (frontRoot, cityId) => {
        const url = frontRoot + "Show/LoadCinemas";
        $.ajax({ 
            url: url,
            method: 'POST',
            data: cityId,
            context: 'document.body',
            success:  function (r) 
            {
                
                let cinemas = $('#comboCinema');

                cinemas.prop('disabled', false);
                // Limpiamos el select
                cinemas.find('option').remove();

                
                let jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
                if(validateNullResponse(jsonText)){
                    
                    cinemas.append("<option value=''>Elija uno...</option>");

                    let json = JSON.parse(jsonText);
                    $(json).each(function(i, v){ 
                        cinemas.append('<option value="' + v.id + '">' + v.name + '</option>');
                    })
                }else{
                    cinemas.append("<option value=''>No se encontraron resultados.</option>");
                }
                
                
            },
            error: function(jqXHR, textStatus )
            {
                alert('Ocurrio un error en el servidor: ' + textStatus);
                cinemas.prop('disabled', true);
            }

        });
    }

    const getRooms = (frontRoot, cinemaId) => {
        const url = frontRoot + "Show/LoadRooms";
        $.ajax({ 
            url: url,
            method: 'POST',
            data: cinemaId,
            context: 'document.body',
            success:  function (r) 
            {
                
                let rooms = $('#comboRoom');

                rooms.prop('disabled', false);
                // Limpiamos el select
                rooms.find('option').remove();
                
                
                let jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
                if(validateNullResponse(jsonText)){
                    rooms.append("<option value=''>Elija uno...</option>");

                    let json = JSON.parse(jsonText);

                    $(json).each(function(i, v){ 
                        rooms.append('<option value="' + v.id + '">' + v.name + '</option>');
                    })
                }else{
                    rooms.append("<option value=''>No se encontraron resultados.</option>");
                }
            },
            error: function(jqXHR, textStatus )
            {
                alert('Ocurrio un error en el servidor: ' + textStatus);
                rooms.prop('disabled', true);
            }

        });
    }

    $('#comboCity').change(() => {
        let id = $('#comboCity').val();
        let data = { cityId: id };
        getCinemas(<?= FRONT_ROOT ?>, data);
    });

    $('#comboCinema').change(() => {
        let id = $('#comboCinema').val();
        let data = { cinemaId: id };
        getRooms(<?= FRONT_ROOT ?>, data);
    });

</script>