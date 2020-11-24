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
                                                data-movieid="<?php echo $show->getMovie()->getId(); ?>"
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
                        <div class="show-combo-container">
                            <form action="<?= FRONT_ROOT ?>Purchase/PurchaseAction" method="POST">
                                
                                <!-- Hidden -->
                                <div class="form-content">
                                    <div class="form-group">
                                        <input type="text" name="movieId" id="movieId" style="display:none;"/>
                                    </div>
                                </div>

                                <div class="form-content">
                                    <div class="form-group">
                                        <input type="number" name="itemPrice" id="itemPrice" style="display:none;"/>
                                    </div>
                                </div>
                                
                                <div class="form-content-billboard">
                                    <!-- Ciudades -->
                                    <div class="form-group">
                                        <label class="cinema-input-label" for="cityId">Ciudad</label>
                                        <select name="cityId" id="citySearchInput" class="form-control form-control-md cinema-input" placeholder="Cines" required>
                                            <option value="" selected> Seleccione... </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-content-billboard">
                                    <!-- Funciones -->
                                    <div class="form-group">
                                        <label class="cinema-input-label" for="showId">Funcion</label>
                                        <select name="showId" id="showSearchInput" class="form-control form-control-md cinema-input" placeholder="Funciones" required>
                                            <option value="" selected> Seleccione... </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-content-billboard">
                                    <!-- Cant tickets -->
                                    <div class="form-group">
                                        <label class="cinema-input-label" for="cantTickets">Cantidad Tickets</label>
                                        <input name="cantTickets" type="number" id="cantTicketsInput" class="form-control form-control-md cinema-input" placeholder="Cantidad Tickets" required> </input>
                                    </div>
                                </div>
                                <div class="form-content-billboard" style="display: none;">
                                    <!-- total -->
                                    <div class="form-group">
                                        <label class="cinema-input-label" for="totalPrice">Precio Total</label>
                                        <input name="totalPrice" type="number" id="totalPriceInput" class="form-control form-control-md cinema-input" placeholder="Precio Total" required> </input>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                        

                        <button type="submit" class="purchase-btn">Comprar</button>
                    </div>
                </div>

                
                
                <!-- 
                POPUP Billboard Cascadear:

                Validar capacidad de sala antes de traer las salas (solo las que tienen capacidad)
                Cada ticket tiene su QR propio
                y el mail que se manda
 
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
        let movieId = button.data('movieid')
        let modal = $(this)

        modal.find(".modal-title").text(title)
        modal.find(".modal-desc").text(description)
        modal.find(".modal-img").attr("src", img);

        //TODO: Review
        $("#movieId").val(movieId)

        getCitysForPurchase(movieId);
    });
    
    const validateNullResponse = (data) => data != '' && data != '[]';

    const getCitysForPurchase = (movieId) => {
        const url = <?= FRONT_ROOT ?> + "Show/LoadCitysForPurchase";
        $.ajax({ 
            url: url,
            method: 'POST',
            data: { movieId },
            context: 'document.body',
            success:  function (r) 
            {

                let citys = $('#citySearchInput');

                citys.prop('disabled', false);
                // Limpiamos el select
                citys.find('option').remove();
                
                
                let jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
                if(validateNullResponse(jsonText)){
                    citys.append("<option value=''>Elija uno...</option>");

                    let json = JSON.parse(jsonText);

                    $(json).each(function(i, v){ 
                        citys.append('<option value="' + v.id + '">' + v.cityDesc + '</option>');
                    })
                }else{
                    citys.append("<option value=''>No se encontraron resultados.</option>");
                }
            },
            error: function(jqXHR, textStatus )
            {
                alert('Ocurrio un error en el servidor: ' + textStatus);
                rooms.prop('disabled', true);
            }

        });
    }

    const getShowsForPurchase = (data) => {
        const url = <?= FRONT_ROOT ?> + "Show/LoadShowsForPurchase";
        $.ajax({ 
            url: url,
            method: 'POST',
            data: data,
            context: 'document.body',
            success:  function (r) 
            {
                let shows = $('#showSearchInput');

                shows.prop('disabled', false);
                // Limpiamos el select
                shows.find('option').remove();
                
                
                let jsonText = r.substring(r.indexOf('$')+1 ,r.indexOf('%'));
                if(validateNullResponse(jsonText)){
                    shows.append("<option value=''>Elija uno...</option>");

                    let json = JSON.parse(jsonText);

                    $(json).each(function(i, v){ 
                        
                        shows.append('<option data-price="' + v.price + '" value="' + v.id + '">'+ v.cinema + ' ' + v.date + '</option>');
                    })
                }else{
                    shows.append("<option value=''>No se encontraron resultados.</option>");
                }
            },
            error: function(jqXHR, textStatus )
            {
                alert('Ocurrio un error en el servidor: ' + textStatus);
                rooms.prop('disabled', true);
            }

        });
    }

    $('#citySearchInput').change(() => {
        let cityId = $('#citySearchInput').val();
        let movieId = $("#movieId").val();
        let data = { cityId: cityId, movieId: movieId };
        getShowsForPurchase(data);
    });

    $('#showSearchInput').change(() => {
        let selected = $('#showSearchInput').find('option:selected')[0];
        let price = selected.dataset.price; 
        //Actualizo precio individual para calcular precio total
        $('#itemPrice').val(price);
    });
    
    $('#cantTicketsInput').change(() => {
        let totalPrice = $('#itemPrice').val() * $('#cantTicketsInput').val();
        //Actualizo precio total
        $('#totalPriceInput').val(totalPrice);
    });
</script>
