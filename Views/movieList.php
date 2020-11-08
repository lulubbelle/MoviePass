<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
        <form action="<?= FRONT_ROOT ?>Movie/MovieSearch" method="POST" class="cinema-form">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Agregar Peliculas</h1>                
                </div>
                <div class="col-md-4">
                    <div class="form-content">
                        <div class="form-group">
                        <select name="genre" id="genre" class="form-control form-control-md cinema-input" placeholder="Genero">
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
                <div class="col-md-3">
                    <div class="form-content">
                        <div class="form-group">
                        <button id="searchMovie" class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>  
        </form>
            <div class="row">
                <div class="col-md-12">
                <!--Listado de Peliculas-->
                <div class="row">
                    <?php foreach($movieList as $movie) { ?>   
                        <div class="col-md-3">
                            <div class="flip-card movieBoxes">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src= "<?= IMG_LINK_W500 . $movie->getImgLink()?>" alt="Avatar" style="width:100%;height:100%;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h1 class="titleMovie"> <?php echo $movie->getTitle(); ?> </h1> 
                                        <a id="add" class="button" href = "<?php echo FRONT_ROOT ?>Show/ShowAddShowView?movieId=<?php echo $movie->getId(); ?>">Agregar</a>
                                        <!-- <a id="edit" class="button" href = "#">Editar</a>
                                        <a id="remove" class="button" href = "#">Eliminar</a> -->
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
</div>

