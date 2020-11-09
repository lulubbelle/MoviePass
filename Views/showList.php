<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/cinemaList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Cine</h1>                
                </div>
            </div>
            <div class="row cinema-header-row">
                <div class="col-md-10 cinema-header">
        <!--<div class="row cinema-header-row">
                <div class="col-md-10 cinema-header"> -->
                   Some Data
                </div>
                <div class="col-md-2">
                    <div class="form-content">
                        <div class="form-group">
                            <a href="#" onclick="alert('todavia no lo hice :v')" class="btn btn-success">Agregar Funcion</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Funciones</h1>                
                </div>
            </div>
            <?php 
            if(!empty($deleteMsg)){
            ?>
                <div class="row text-center">
                    <p class="alert alert-danger ml-5 mr-5"><?=$deleteMsg?></p>
                </div>
            <?php 
            }
            ?>
            <?php 
            if(!empty($successMsg)){
            ?>
                <div class="row text-center">
                    <p class="alert alert-success ml-5 mr-5"><?=$successMsg?></p>
                </div>
            <?php 
            }
            ?>
            
            <div class="row">
                <div class="col-md-12">
                <!--Listado de Cines-->
                    <div class="row">
                        <div class="cinema-list">
                        <?php 
                        foreach($shows as $key){
                        ?>
                            <!--Items de Cines-->
                            <div class="row show-item">
                                <div class="col-md-7">
                                    <h3>Pelicula: <?= $key->getMovie()->getTitle() ?></h3>
                                    <br/>
                                    <h3>Fecha Desde: <?= date('Y-m-d h:m:s', strtotime($key->getDateTimeFrom())) ?> </h3>
                                    <br/>
                                    <h3>Fecha Hasta: <?= date('Y-m-d h:m:s', strtotime($key->getDateTimeTo())) ?> </h3>
                                    <br/>
                                    <h3>Cine: <?= $key->getCinema()->getName() ?> </h3>
                                    <br/>
                                    <h3>Sala: <?= $key->getRoom()->getName() ?> </h3>
                                    <br/>
                                    <h3>Precio: <?= $key->getRoom()->getPrice() ?> </h3>
                                    <br/>
                                    <h3>Capacidad: <?= $key->getRoom()->getCapacity() ?> </h3>
                                    <br/>
                                </div>
                                <div class="col-md-2">
                                    <a type="button" class="btn btn-danger btn-abm-cinema" title="Eliminar Show" href="<?= FRONT_ROOT ?>Show/DeleteShow?id=<?=$key->getId()?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="white" fill-rule="evenodd" d="M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z"></path><path d="M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z" fill="white"></path><path d="M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z" fill="white"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-content">
                                        <div class="form-group">
                                        <img src= "<?= IMG_LINK_W500 . $key->getMovie()->getImgLink()?>" alt="Avatar" style="width:100%;height:100%;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                            <?php 
                                if(count($shows) == 0){
                            ?>
                            <div class="alert alert-danger">
                                    No se encontraron resultados :(
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>