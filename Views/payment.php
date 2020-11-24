<?php require_once(VIEWS_PATH . "nav.php"); ?>

<link rel="stylesheet" href="<?= CSS_PATH ?>/purchaseList.css">
<link rel="stylesheet" href="<?= CSS_PATH ?>/payment.css">

<div class="container">
    <div id="box" class="row justify-content-center" style="background-color: #242424;">
        <!-- Inicio de la pantalla de pagos -->
        <div class="col-md-12">
            <div class="col-md-3">
                <h1 class="basic-font purchase-view-title">Realizar pago</h1>                
            </div>
            <div class="row mt-5 ml-4">
                <div class="col-md-4">
                    <div class="card" style="background-color: #242424; width: 18rem;">
                        <div class="basic-font card-header text-center title-info">
                            Detalles de la pelicula
                        </div>
                        <ul class="list-group list-group-flush">                            
                            <li class="basic-font list-group-item purchase-info-item " style="background-color: #242424;">Ciudad: <?= $show->getCity()->getName()?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Cine: <?= $show->getCinema()->getName()?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Sala: <?= $show->getRoom()->getName()?></li>                            
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #242424; width: 18rem;">
                        <div class="basic-font card-header text-center title-info">
                            Detalles de la función
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Pelicula: <?= $show->getMovie()->getTitle()?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Inicio: <?= $show->getDateTimeFrom()?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Finalización: <?= $show->getDateTimeTo() ?></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #242424; width: 18rem;">
                        <div class="basic-font card-header text-center title-info">
                            Detalles de la compra
                        </div>
                        <ul class="list-group list-group-flush">                        
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Precio por entrada: $<?= $itemPrice ?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Cantidad de entradas: <?= $cantTickets ?></li>
                            <li class="basic-font list-group-item purchase-info-item" style="background-color: #242424;">Total: $<?= $totalPrice ?></li>
                        </ul>
                    </div>
                </div>                
            </div>

            <div class="payment-container">
                <!-- Tarjeta -->
                <section class="tarjeta" id="tarjeta">
                    <div class="delantera">
                        <div class="logo-marca" id="logo-marca">
                            <!-- <img src="<?= IMG_PATH ?>visa.png" alt=""> -->
                        </div>
                        <img src="<?= IMG_PATH ?>chip-tarjeta.png" class="chip" alt="">
                        <div class="datos">
                            <div class="grupo" id="numero">
                                <p class="label">Número Tarjeta</p>
                                <p class="numero">#### #### #### ####</p>
                            </div>
                            <div class="flexbox">
                                <div class="grupo" id="nombre">
                                    <p class="label">Nombre Tarjeta</p>
                                    <p class="nombre">Jhon Doe</p>
                                </div>

                                <div class="grupo" id="expiracion">
                                    <p class="label">Expiracion</p>
                                    <p class="expiracion"><span class="mes">MM</span> / <span class="year">AA</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="trasera">
                        <div class="barra-magnetica"></div>
                        <div class="datos">
                            <div class="grupo" id="firma">
                                <p class="label">Firma</p>
                                <div class="firma"><p></p></div>
                            </div>
                            <div class="grupo" id="ccv">
                                <p class="label">CCV</p>
                                <p class="ccv"></p>
                            </div>
                        </div>
                        <p class="leyenda">Hola necesito una descripcion larga por que sino se corre todo el diseño asi que tengo que escribir.</p>
                        <a href="#" class="link-banco">www.moviepass.com</a>
                    </div>
                </section>

                <!-- Contenedor Boton Abrir Formulario -->
                <div class="contenedor-btn" style="display: none;">
                    <button class="btn-abrir-formulario" id="btn-abrir-formulario">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <!-- Formulario -->
                <form action="<?= FRONT_ROOT ?>Purchase/DoPurchase" id="formulario-tarjeta" class="formulario-tarjeta active" method="POST">
                    <span class="text-danger" id="errorMessage" style="font-size: 1.4rem"></span>
                    <div class="grupo">
                        <label for="inputNumero">Número Tarjeta</label>
                        <input type="text" id="inputNumero" maxlength="19" autocomplete="off" required>
                    </div>
                    <div class="grupo">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" id="inputNombre" maxlength="19" autocomplete="off" required>
                    </div>
                    <div class="flexbox">
                        <div class="grupo expira">
                            <label for="selectMes">Expiracion</label>
                            <div class="flexbox">
                                <div class="grupo-select">
                                    <select name="mes" id="selectMes" required>
                                        <option disabled selected>Mes</option>
                                    </select>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                                <div class="grupo-select">
                                    <select name="year" id="selectYear" required>
                                        <option disabled selected>Año</option>
                                    </select>
                                    <i class="fas fa-angle-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="grupo ccv">
                            <label for="inputCCV">CCV</label>
                            <input type="text" id="inputCCV" maxlength="3" required>
                        </div>
                    </div>

                    <!-- Purchase data -->

                    <input type="text" name="showId" value="<?= $show->getId()?>" style="display:none;">
                    <input type="text" name="itemPrice" value="<?= $itemPrice?>" style="display:none;">
                    <input type="text" name="cantTickets" value="<?= $cantTickets?>" style="display:none;">

                    <button onclick="confirmarCompra()" class="btn-enviar">Confirmar Compra😁</button>
                </form>
            </div>
            </div>
            <!-- Fin tarjeta de credito -->
        </div>
    </div>
</div>

<script>
    const tarjeta = document.querySelector('#tarjeta'),
	  btnAbrirFormulario = document.querySelector('#btn-abrir-formulario'),
	  formulario = document.querySelector('#formulario-tarjeta'),
	  numeroTarjeta = document.querySelector('#tarjeta .numero'),
	  nombreTarjeta = document.querySelector('#tarjeta .nombre'),
	  logoMarca = document.querySelector('#logo-marca'),
	  firma = document.querySelector('#tarjeta .firma p'),
	  mesExpiracion = document.querySelector('#tarjeta .mes'),
	  yearExpiracion = document.querySelector('#tarjeta .year');
	  ccv = document.querySelector('#tarjeta .ccv');

const mostrarFrente = () => {
	if(tarjeta.classList.contains('active')){
		tarjeta.classList.remove('active');
	}
}

// * Rotacion de la tarjeta
tarjeta.addEventListener('click', () => {
	tarjeta.classList.toggle('active');
});

// * Boton de abrir formulario
btnAbrirFormulario.addEventListener('click', () => {
	btnAbrirFormulario.classList.toggle('active');
	formulario.classList.toggle('active');
});

// * Select del mes generado dinamicamente.
for(let i = 1; i <= 12; i++){
	let opcion = document.createElement('option');
	opcion.value = i;
	opcion.innerText = i;
	formulario.selectMes.appendChild(opcion);
}

// * Select del año generado dinamicamente.
const yearActual = new Date().getFullYear();
for(let i = yearActual; i <= yearActual + 8; i++){
	let opcion = document.createElement('option');
	opcion.value = i;
	opcion.innerText = i;
	formulario.selectYear.appendChild(opcion);
}

// * Input numero de tarjeta
formulario.inputNumero.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.inputNumero.value = valorInput
	// Elimina espacios en blanco
	.replace(/\s/g, '')
	// Elimina letras
	.replace(/\D/g, '')
	// Inserta un espacio cada 4 digitos
	.replace(/([0-9]{4})/g, '$1 ')

	.trim();

	numeroTarjeta.textContent = valorInput;

	if(valorInput == ''){
		numeroTarjeta.textContent = '#### #### #### ####';

		logoMarca.innerHTML = '';
	}

	if(valorInput[0] == 4){
		logoMarca.innerHTML = '';
		const imagen = document.createElement('img');
		imagen.src = '<?= IMG_PATH ?>visa.png';
		logoMarca.appendChild(imagen);
	} else if(valorInput[0] == 5){
		logoMarca.innerHTML = '';
		const imagen = document.createElement('img');
		imagen.src = '<?= IMG_PATH ?>mastercard.png';
		logoMarca.appendChild(imagen);
	}

	mostrarFrente();
});

// * Input nombre de tarjeta
formulario.inputNombre.addEventListener('keyup', (e) => {
	let valorInput = e.target.value;

	formulario.inputNombre.value = valorInput.replace(/[0-9]/g, '');
	nombreTarjeta.textContent = valorInput;
	firma.textContent = valorInput;

	if(valorInput == ''){
		nombreTarjeta.textContent = 'Jhon Doe';
	}

	mostrarFrente();
});

// * Select mes
formulario.selectMes.addEventListener('change', (e) => {
	mesExpiracion.textContent = e.target.value;
	mostrarFrente();
});

// * Select Año
formulario.selectYear.addEventListener('change', (e) => {
	yearExpiracion.textContent = e.target.value.slice(2);
	mostrarFrente();
});

// * CCV
formulario.inputCCV.addEventListener('keyup', () => {
	if(!tarjeta.classList.contains('active')){
		tarjeta.classList.toggle('active');
	}

	formulario.inputCCV.value = formulario.inputCCV.value
	// Elimina los espacios
	.replace(/\s/g, '')
	// Elimina las letras
	.replace(/\D/g, '');

	ccv.textContent = formulario.inputCCV.value;
});

const confirmarCompra = () => {
    event.preventDefault()
    
    document.getElementById('errorMessage').innerHTML = ''
    
    let isValid = false;
    let errorMsg = '';

    let inputNumber = formulario.inputNumero.value
    
    let visaExpression =  /\b4(?:\d[ -]*?){15}\b/;
    let masterExpression = /\b5(?:\d[ -]*?){15}\b/;
    
    //Numero Tarjeta
    isValid = visaExpression.test(inputNumber) || masterExpression.test(inputNumber)
    if(!isValid)
        errorMsg += 'Debe ingresar un numero de tarjeta valido.  (╯°□°）╯︵ ┻━┻ <br>'
    
    //Fechas Correctas
    isValid = Number.isInteger(parseInt(mesExpiracion.textContent)) && Number.isInteger(parseInt(yearExpiracion.textContent))
    if(!isValid)
        errorMsg += 'Debe ingresar una fecha de vencimiento <br>'
    
    //Codigo de seguridad correcto
    isValid = formulario.inputCCV.value.length == 3 && Number.isInteger(parseInt(yearExpiracion.textContent))
    if(!isValid)
        errorMsg += 'Debe ingresar un codigo de seguridad valido <br>'

    //Nombre Valido
    isValid = formulario.inputNombre.value.length != 0;
    if(!isValid)
        errorMsg += 'Debe ingresar un nombre valido <br>'

    if(errorMsg == '')
        $('form').submit()
    else
        document.getElementById('errorMessage').innerHTML = errorMsg;
}
</script>

<style>
.tarjeta .delantera {
	width: 100%;
	background: url(<?= IMG_PATH ?>bg-tarjeta-01.jpg);
	background-size: cover;
}

.trasera {
	background: url(<?= IMG_PATH ?>bg-tarjeta-01.jpg);
	background-size: cover;
	position: absolute;
	top: 0;
	transform: rotateY(180deg);
	backface-visibility: hidden;
}
</style>