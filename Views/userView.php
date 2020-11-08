<?php require_once(VIEWS_PATH."nav.php"); ?>
<link rel="stylesheet" href="<?= CSS_PATH ?>/user.css">

<div class="row">
<div class="card-container">
        <div class="col-md-12">
    <img
        class="img-profile"
        src="https://randomuser.me/api/portraits/women/79.jpg"
        alt="user"
    />
    <?php if(isset($user)) {?>
        <h1 class="profile-title">Bienvenido <?php echo $user->getUserName() ?></h3>
        <div class="text-container">
            <h3 class="profile-text">Email: <span class="profile-info"><?php echo $user->getMail() ?></span></h3>
            <h3 class="profile-text">Usuario: <span class="profile-info"><?php echo $user->getUserName() ?></span></h3>
            <?php if(isset($profile)) {?>
            <h3 class="profile-text">Nombre: <span class="profile-info"><?php echo $profile->getFirstName() ?></span></h3>
            <h3 class="profile-text">Apellido: <span class="profile-info"><?php echo $profile->getLastName() ?></span></h3>
            <h3 class="profile-text">DNI: <span class="profile-info"><?php echo $profile->getDNI() ?></span></h3>

            <a href="<?php echo FRONT_ROOT ?>Profile/UpdateUserShowView" class="btn btn-success btn-block btn-profile"><i class="fas fa-save"></i>&nbspModificar Datos</a>
        </div>
        <?php }
        }?>

    </div>
    </div>
</div>
