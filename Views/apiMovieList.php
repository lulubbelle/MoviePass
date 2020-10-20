<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
        <form action="<?= FRONT_ROOT ?>ApiMovie/MovieSearch" method="POST" class="cinema-form">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Agregar Peliculas</h1>                
                </div>
                <!-- <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                            <select name="city" id="citys" class="form-control form-control-md cinema-input" placeholder="Ciudad">
                                    <option value="Marpla">Marpla</option>
                                    <option value="Batan">Batan</option>
                                    <option value="Miramar">Miramar</option>
                                    <option value="Villa Gessel">Villa Gessel</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                        <select name="cinema" id="cinema" class="form-control form-control-md cinema-input" placeholder="Cine">
                                <option value="volvo">Ambassador</option>
                                <option value="saab">Los Gallegos</option>
                                <option value="mercedes">Aldrey</option>
                                <option value="audi">Cines del Paseo</option>
                            </select>
                        </div>
                    </div>
                </div> -->
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
                    <?php foreach($movieList as $movies) { ?>   
                        <div class="col-md-3">
                            <div class="flip-card movieBoxes">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src= "https://image.tmdb.org/t/p/w500<?php echo $movies->getImgLink()?>" alt="Avatar" style="width:100%;height:100%;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h1 class="titleMovie"> <?php echo $movies->getTitle(); ?> </h1> 
                                        <p><?php echo $movies->getReleaseDate(); ?></p> 
                                        <a id="add" class="button" href = "<?php echo FRONT_ROOT ?>Movies/AddMovieToDatabase?IdMovieIMDB=<?php echo $movies->getIdApi(); ?>">Agregar</a>
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

