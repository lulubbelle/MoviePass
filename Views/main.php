<?= require_once(VIEWS_PATH."nav.php"); ?>
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
                        <img src="<?= IMG_PATH ?>banner1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Malefica</h5>
                            <p>Angelina Jolie interpreta a la hada de grandes cuernos, quien es traicionada por su gran amor y que actúa movida por el dolor.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= IMG_PATH ?>banner2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Joker</h5>
                            <p>La pasión de Arthur Fleck, un hombre ignorado por la sociedad, es hacer reír a la gente. Una serie de trágicos sucesos lo convertiran en un brillante criminal.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="<?= IMG_PATH ?>banner3.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Avengers: EndGame</h5>
                            <p>Los Vengadores restantes deben encontrar una manera de recuperar a sus aliados para un enfrentamiento épico con Thanos.</p>
                        </div>
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