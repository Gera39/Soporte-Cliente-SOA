<?php
require_once ("../../Conexion/ConsumoApi.php");
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");
require_once "../modal.php";
$resultados = $apiClient->get("servicios");
$inter = 0;
$otros = 0;
$costo = 0;
foreach($resultados as $servicio){
	$costo += $servicio["costo"];
	if(substr($servicio["nombre_servicio"],0,4) == "Inte"){
		$inter ++;
	}else {
		$otros++;
	}
}


?>



<main>
    <div class="head-title">
        <div class="left">
            <h1>Servicios</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Administrador</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Servicios</a>
                </li>
            </ul>
        </div>

    </div>

    <ul class="box-info">
        <h3>Contratados</h3>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>$<?=$costo?></h3>
                <p>Total de costos de servicios</p>
            </span>
        </li>
        <li>
            <i class='bx bx-phone-call'></i>
            <span class="text">
                <h3><?=$otros?></h3>
                <p>Telecomunicación</p>
            </span>
        </li>
        <li>
            <i class='bx bx-wifi' style="background-color:#ffffff;"></i>
            <span class="text">
                <h3><?=$inter?></h3>
                <p>Internet</p>
            </span>
        </li>
    </ul>


    <div class="table-data">

        <div class="todo">
            <div class="head">
                <h3>Servicios</h3>
                <?php
					mostrarModal("Insertar Nuevo Servicio",'
					<i class="bx bx-box" style="font-size:50px;"></i>
                    <div class="mb-3">
                        <label for="service-name" class="form-label">Nombre del Servicio</label>
                        <input type="text" class="form-control" id="service-name" name="nombre_servicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="service-description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="service-description" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="service-cost" class="form-label">Costo</label>
                        <input type="number" class="form-control" id="service-cost" name="costo" required>
                    </div>
                    <input type="hidden" id="service-id" name="id_servicio">
              
					','insertarServicio.php');
				?>
 
                <a href="#" class="botonchido " style='font-size:35px; ' data-bs-toggle="modal" data-bs-target="#myModal"><i
                        class='bx bx-plus'></i></a>
                <i class='bx bx-filter'></i>
            </div>
            <ul class="todo-list">
                <?php
                        
						$clase = "";
							foreach($resultados as $servicio){
								if(substr($servicio["nombre_servicio"],0,4) == "Inte"){
									$clase = "completed";
								}else {
									$clase ="not-completed";
								}
								?>

                <li class="<?=$clase?>">

                    <p><strong><?=$servicio["nombre_servicio"]?></strong><br>
                        <?=$servicio["descripcion"]?><br>
                        $<?=$servicio["costo"]?></p>
                    <button id="botoncitoInfo" type="button" class="btn botonchido" data-bs-toggle="modal"
                        data-bs-target="#actualizarModal<?=$servicio["id_servicio"]?>">
                        <i class='bx bx-edit-alt' style="font-size:30px;"></i>
                    </button>
                </li>
                <?php
                    actualizarModal($servicio["id_servicio"],$servicio["nombre_servicio"],$servicio["descripcion"],$servicio["costo"]);
                
                 
							}
                           
						?>


            </ul>
        </div>
    </div>

    

   




</main>