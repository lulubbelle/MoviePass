<div>
<h1>CINES</h1>

  
<form action="<?= FRONT_ROOT ?>CineAbm/AddCine" method="POST" class="login-form">
        <?php if(isset($errorCineAbm)) {?>
            <strong style="color:red;"><?=$errorCineAbm?></strong>
        <?php }?>
        <div class="form-content">
            <div class="form-group">
                <label class="login-input-label" for="capacidad">Capacidad</label>
                <input type="number" name="capacidad" class="form-control form-control-md login-input" placeholder="Capacidad" required>
            </div>
            <div class="form-group">
                <label class="login-input-label" for="valorEntrada">Valor Entrada</label>
                <input type="number" name="valorEntrada" class="form-control form-control-md login-input" placeholder="Valor Entrada" required>
            </div>
            
            <div class="form-group">
                <label class="login-input-label" for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control form-control-md login-input" placeholder="Nombre" required>
            </div>
            
            <div class="form-group">
                <label class="login-input-label" for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control form-control-md login-input" placeholder="Direccion" required>
            </div>
            
        </div>
        <button class="login-btn" type="submit">Crear Cine</button>
</form>

</div>