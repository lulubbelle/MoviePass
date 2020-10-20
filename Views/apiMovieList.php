<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Agregar Peliculas</h1>                
                </div>
                <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                            <select name="city" id="citys" class="form-control form-control-md cinema-input" placeholder="Ciudad">
                                <option value="volvo">Marpla</option>
                                <option value="saab">Batan</option>
                                <option value="mercedes">Miramar</option>
                                <option value="audi">Villa Gessel</option>
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
                </div>
                <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                        <select name="genre" id="genre" class="form-control form-control-md cinema-input" placeholder="Genero">
                                <option value="volvo">Comedia</option>
                                <option value="saab">Romantica</option>
                                <option value="mercedes">Terror</option>
                                <option value="audi">Accion</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-content">
                        <div class="form-group">
                        <button class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                <!--Listado de Peliculas-->

                    <?php foreach($movieList as $movies) { ?>   
                        <div class="col-md-3">
                            <div class="flip-card movieBoxes">
                                <div class="flip-card-inner">
                                    <div class="flip-card-front">
                                        <img src= "<?php echo $movies->getPhoto()?>" alt="Avatar" style="width:100%;height:100%;">
                                    </div>
                                    <div class="flip-card-back">
                                        <h1> <?php echo $movies->getMovieName(); ?> </h1> 
                                        <p><?php echo $movies->getReleaseDate(); ?></p> 
                                        <p><a id="addMovie" href = "<?php echo FRONT_ROOT ?>Movies/AddMovieToDatabase?IdMovieIMDB=<?php echo $movies->getIdMovieIMDB(); ?>"><button id="add" class="button">Agregar</button></a></p>
                                        <p><a id="editMovie" href = "#"></a><button id="edit" class="button">Editar</a></button></p>
                                        <p><a id="removeMovie" href = "#"></a><button id="remove" class="button">Eliminar</a></button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <!--Termina Listado de Peliculas-->
                </div>
            </div>
        </div>
    </div>
</div>