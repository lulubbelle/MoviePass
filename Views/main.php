<?php require_once(VIEWS_PATH."nav.php"); ?>
<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">
<div class="container">
    <!-- Inicio Index -->
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <div id="colCarousel" class="col-md-10">
            <!-- Inicio carrusel -->
            <div id="carouselMovies" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselMovies" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselMovies" data-slide-to="1"></li>
                    <li data-target="#carouselMovies" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?= IMG_PATH ?>banner1.jpg" class="d-block w-100" alt="..." width="920" height="480">                        
                    </div>
                    <div class="carousel-item">
                        <img src="<?= IMG_PATH ?>banner2.jpg" class="d-block w-100" alt="..." width="920" height="480">                        
                    </div>
                    <div class="carousel-item">
                        <img src="<?= IMG_PATH ?>banner3.png" class="d-block w-100" alt="..." width="920" height="480">                       
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselMovies" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselMovies" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <!-- Fin Carrusel -->
        </div>
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
            <h1 class="basic-font" style="margin: 2% 0 0 3%;">Estrenos</h1>
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
                                                <a id="add" class="button" data-toggle="modal" data-target="#purchaseModal">Reservar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <!--Termina Listado de Peliculas-->
                    </div>
                </div>
        </div>

</div>

<!-- Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="purchaseModalLabel">Comprar entradas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Work in Progress
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Confirmar compra</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#purchaseModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
    });
</script>