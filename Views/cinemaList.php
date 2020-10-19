<?php require_once(VIEWS_PATH."nav.php"); ?>
<link rel="stylesheet" href="<?= CSS_PATH ?>/cinema.css">
<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Cines</h1>                
                </div>
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <div class="form-content">
                        <div class="form-group">
                            <button class="cinema-btn" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <!--Listado de Cines-->
                    <div class="row">
                        <div class="cinema-list">
                            <!--Items de Cines-->
                            <div class="cinema-item">
                                <div class="column-1">
                                    <h3>Cinemacenter</h3>
                                    <br/>
                                    <h3>4.2</h3>
                                    <br/>
                                    <h3>Diagonal Pueyrredon 3050</h3>
                                    <br/>
                                    <h3>Horario: 10:00 - 2:00</h3>
                                </div>
                                <div class="column-2">
                                    <img src="<?= IMG_PATH ?>/CinemaLosGallegos.jpg" width="225" height="125"/>
                                </div>
                            </div>

                            <!--Items de Cines-->
                            <div class="cinema-item">
                                <div class="column-1">
                                    <h3>Cinemacenter</h3>
                                    <br/>
                                    <h3>4.2</h3>
                                    <br/>
                                    <h3>Diagonal Pueyrredon 3050</h3>
                                    <br/>
                                    <h3>Horario: 10:00 - 2:00</h3>
                                </div>
                                <div class="column-2">
                                    <img src="<?= IMG_PATH ?>/CinemaLosGallegos.jpg" width="225" height="125"/>
                                </div>
                            </div>

                            <!--Items de Cines-->
                            <div class="cinema-item">
                                <div class="column-1">
                                    <h3>Cinemacenter</h3>
                                    <br/>
                                    <h3>4.2</h3>
                                    <br/>
                                    <h3>Diagonal Pueyrredon 3050</h3>
                                    <br/>
                                    <h3>Horario: 10:00 - 2:00</h3>
                                </div>
                                <div class="column-2">
                                    <img src="<?= IMG_PATH ?>/CinemaLosGallegos.jpg" width="225" height="125"/>
                                </div>
                            </div>

                            <!--Items de Cines-->
                            <div class="cinema-item">
                                <div class="column-1">
                                    <h3>Cinemacenter</h3>
                                    <br/>
                                    <h3>4.2</h3>
                                    <br/>
                                    <h3>Diagonal Pueyrredon 3050</h3>
                                    <br/>
                                    <h3>Horario: 10:00 - 2:00</h3>
                                </div>
                                <div class="column-2">
                                    <img src="<?= IMG_PATH ?>/CinemaLosGallegos.jpg" width="225" height="125"/>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


