<?php require_once(VIEWS_PATH."nav.php"); ?>
<link rel="stylesheet" href="<?= CSS_PATH ?>/user.css">

<div class="card-container">
<div class="row">
        <div class="col-md-12">
    <img
        class="round"
        src="https://randomuser.me/api/portraits/women/79.jpg"
        alt="user"
    />
    <h3>Bienvenido <?php echo $user->getUserName() ?></h3>
    <h3>Email: <?php echo $user->getMail() ?></h3>
    <h3>Usuario: <?php echo $user->getUserName() ?></h3>
    <h3>nombre: <?php echo $profile->getFirstName() ?></h3>
    <h3>Apellido: <?php echo $profile->getLastName() ?></h3>
    <h3>DNI: <?php echo $profile->getDNI() ?></h3>

  
    <a href="<?php echo FRONT_ROOT ?>Profile/UpdateUserShowView" class="btn btn-success"><i class="fas fa-save"></i>&nbspModificar Datos</a>
    </div>
    </div>
</div>

