<?php require_once(VIEWS_PATH."nav.php"); ?>

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
            <h1 class="basic-font">Estrenos</h1>
        </div>

</div>