<?php require_once(VIEWS_PATH . "nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/purchaseList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
            <form action="<?= FRONT_ROOT ?>purchase/purchaseSearch" method="POST" class="purchase-form">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h1 class="basic-font purchase-view-title">Compras</h1>
                    </div>
                </div>
            </form>
            <?php
            if (!empty($deleteMsg)) {
            ?>
                <div class="row text-center">
                    <p class="alert alert-danger ml-5 mr-5"><?= $deleteMsg ?></p>
                </div>
            <?php
            }
            ?>
            <?php
            if (!empty($successMsg)) {
            ?>
                <div class="row text-center">
                    <p class="alert alert-success ml-5 mr-5"><?= $successMsg ?></p>
                </div>
            <?php
            }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <!--Listado de Compras-->
                    <div class="row">
                        <div class="purchase-list">
                           
                                    <!--Items de Compras-->
                                    <div class="purchase-item">
                                        <div class="column-1">
                                            <h3>Titulo Pelicula</h3>
                                            <br />
                                            <p>
                                                Descripcion pelicula Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quos, in nemo cum aut earum eum enim quibusdam repellat. 
                                                Eos qui omnis suscipit deleniti cumque molestias sint iste voluptas quae?
                                            </p>
                                            <br />
                                            <p>Cine: Los gallegos</p>
                                            <p>Horario: 22:30</p>
                                            <p>Fecha: 22 de diciembre</p>
                                            <button type="submit" class="purchase-btn">Ver Compra</button>
                                        </div>
                                        <div class="column-2">                            
                                            <img class="purchase-img" src="<?= IMG_LINK_W500 ?>/h8Rb9gBr48ODIwYUttZNYeMWeUU.jpg" width="195" height="275" />
                                        </div>
                                    </div>
                            


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>