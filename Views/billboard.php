<?php require_once(VIEWS_PATH."nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/apiMovieList.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio Listado de Estrenos -->
        <div class="col-md-12">
        <form action="" method="POST" class="cinema-form">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="basic-font cinema-view-title">Cartelera</h1>                
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="purchaseModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="purchaseModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <img class="modal-img" src="" width="195" height="275">
            <p class="modal-desc"></p>
      </div>    
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success">Confirmar compra</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#purchaseModal').on('shown.bs.modal', function (e) {
        $('#myInput').trigger('focus');
        debugger;
        let button = $(e.relatedTarget)
        let title = button.data('title')
        let description = button.data('desc')
        let img = button.data('img')
        let modal = $(this)

        modal.find(".modal-title").text(title)
        modal.find(".modal-desc").text(description)
        modal.find(".modal-img").attr("src", img);
    });
</script>
