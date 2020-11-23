<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
        <!-- Formulario -->
            <form action="<?= FRONT_ROOT ?>Show/GetShowsByGenreAndDateRange" method="GET" class="cinema-form">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h1 class="basic-font cinema-view-title">Cartelera</h1>                
                    </div>
                    <div class="col-md-12 filter-container">

                            <?php if(isset($errorMsg)&& !empty($errorMsg)) {?>
                                <div class="alert alert-danger ml-5 mr-5 alert-dismissible fade show" role="alert">
                                    <span><?=$errorMsg?></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php }?>
                        
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-content">
                                        <!-- Genero -->
                                        <div class="form-group">
                                            <label class="cinema-input-label" for="genreId">Genero</label>
                                            <select name="genreId" id="genre" class="form-control form-control-md cinema-input" placeholder="Genero">
                                                <?php 
                                                    foreach($genres as $genre){
                                                        ?>
                                                        <option value="<?=$genre->getId()?>"><?=$genre->getName()?></option>
                                                <?php 
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <!-- Fecha Desde -->
                                    <div class="form-content">
                                        <div class="form-group">
                                            <label class="cinema-input-label" for="dateTimeFrom">Fecha Desde</label>
                                            <input name="dateTimeFrom" id="dateTimeFrom" type="datetime-local" min="<?php echo date("Y-m-d")?>T00:00" class="form-control form-control-md cinema-input" placeholder="Fecha / Hora" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-content">
                                        <!-- Fecha hasta -->  
                                        <div class="form-group">
                                            <label class="cinema-input-label" for="dateTimeTo">Fecha Hasta</label>
                                            <input name="dateTimeTo" id="dateTimeTo" type="datetime-local" min="<?php echo date("Y-m-d")?>T00:00" class="form-control form-control-md cinema-input" placeholder="Fecha / Hora" required />
                                        </div>
                                    </div>    
                                </div>            
                            </div>
                            <div class="row" >
                                <div class="col-md-4 offset-4">
                                    <div class="form-content">
                                        <div class="form-group">
                                            <button id="searchMovie" class="btn btn-block btn-primary" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>  
            </form>

            <div class="row">
                <div class="col-md-12">
                <!--Listado de Peliculas-->
                    <div class="row">
                        <?php foreach($shows as $show) { ?>   
                            <div class="col-md-3">
                                <div class="flip-card movieBoxes">
                                    <div class="flip-card-inner">
                                        <div class="flip-card-front">
                                            <img src= "<?= IMG_LINK_W500 . $show->getMovie()->getImgLink()?>" alt="Avatar" style="width:100%;height:100%;">
                                        </div>
                                        <div class="flip-card-back">
                                            <h1 class="titleMovie"> <?php echo $show->getMovie()->getTitle(); ?> </h1> 
                                            <a 
                                                id="add" 
                                                class="button" 
                                                data-toggle="modal" 
                                                data-target="#purchaseModal" 
                                                data-title="<?php echo $show->getMovie()->getTitle(); ?>" 
                                                data-desc="<?php echo $show->getMovie()->getDescription(); ?>" 
                                                data-img="<?= IMG_LINK_W500 . $show->getMovie()->getImgLink()?>" 
                                            >
                                                Reservar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <!--Termina Listado de Peliculas-->
                </div>
            </div>
            <!-- Termina la row -->
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Realizar compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <div class="modal-first-column">
                        <img class="modal-img modal-image" src="" width="215" height="295">
                    </div>
                    <div class="modal-second-column">
                        <h5 class="modal-title show-header" id="purchaseModalLabel"></h5>
                        <div class="show-description-container">
                            <p class="modal-desc show-description"></p>
                        </div>
                        <span class="show-info">Categoría: Aventura - Accion</span>
                        <div class="show-combo-container">
                            <div class="form-content">
                                <!-- Ciudades -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="cityId">Ciudad</label>
                                    <select name="cityId" id="cinemaSearchInput" class="form-control form-control-md cinema-input" placeholder="Cines" required>
                                        <option value="" selected> Seleccione... </option>
                                        <!-- <?php 
                                            foreach($cinemas as $cinema){
                                                ?>
                                                <option value="<?=$cinema->getId()?>"><?=$cinema->getName()?></option>
                                                <?php 
                                            }
                                            ?>                                             -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-content">
                                <!-- Funciones -->
                                <div class="form-group">
                                    <label class="cinema-input-label" for="showId">Funcion</label>
                                    <select name="showId" id="showSearchInput" class="form-control form-control-md cinema-input" placeholder="Funciones" required>
                                        <option value="" selected> Seleccione... </option>
                                        <!-- <?php 
                                                foreach($cinemas as $cinema){
                                                    ?>
                                                    <option value="<?=$cinema->getId()?>"><?=$cinema->getName()?></option>
                                                    <?php 
                                                }
                                                ?>                                             -->
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <span class="show-info">Cine: Ambassador</span>
                        <br/>
                        <span class="show-info">Sala: Sala Atmos</span>
                        

                        <button type="submit" class="purchase-btn">Comprar</button>
                    </div>
                </div>

                
                
                <!-- 
                POPUP Billboard Cascadear:

                Ciudad->¿fecha?->Funciones->Cantidad Tickets (mostrar precio total)
                Compra 1 -> N Tickets
                Validar capacidad de sala antes de traer las salas (solo las que tienen capacidad)
                Cada ticket tiene su QR propio
                y el mail que se manda

                esto te lleva a la pantalla "Realizar pago" 
                Si es martes o miercoles aplicar descuento (si compra 2 o + entradas)
                dsp de pagar la guardamos en base y mandamos mail y la entrada tiene QR con un hash del ticket que guardamos en base (entidad ticket)

                redirige a "Mis compras" ordenando por fecha funcion

                Nueva pantalla "ver estadisticas o detalles"
                c- Consultar cantidades vendidas y remanentes de las proyecciones (Película, Cine, Turno)
                d- Consultar totales vendidos en pesos (por película ó por cine, entre fechas)


                Linkear funcionalidad de updatear peliculas desde la API -->
            </div>   
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#purchaseModal').on('shown.bs.modal', function (e) {
        $('#myInput').trigger('focus');
        
        let button = $(e.relatedTarget)
        let title = button.data('title')
        let description = button.data('desc')
        let img = button.data('img')
        let modal = $(this)

        modal.find(".modal-title").text(title)
        modal.find(".modal-desc").text(description)
        modal.find(".modal-img").attr("src", img);
    });
</script>
