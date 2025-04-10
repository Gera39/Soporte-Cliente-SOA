<?php
	require_once ("../Conexion/ConsumoApi.php");
    require_once "../Conexion/Sesion.php";
	$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

    $username = Sesion::getUsername();
    $infoEmpleado = $apiClient->post("empleado",["username"=> $username]);
    $horaInicio ="";
    $horaFin ="";
    $dias="";
    if($infoEmpleado[0]["horario"] != null){
        list($horarios,$dias) = explode(",",$infoEmpleado[0]["horario"]);
        list($horaInicio,$horaFin) = explode("-",$horarios);
    }
   

    $tickets = $apiClient->post("ticketEmpledo",["username"=> $username]);
    $abiertos = 0;
    $cerrados = 0;
    $estado = "";
    if(!empty($_GET["estado"])){
        $estado = $_GET["estado"];

    }
    foreach ($tickets as $ticket) {
        if ($ticket["estado"] === "Abierto") {
            $abiertos++;
        }else if($ticket["estado"] === "Cerrado"){
            $cerrados++;
        }
    }
     

?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Vista Rapida</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Operador</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Vista Rapida</a>
                </li>
            </ul>
        </div>
        <?php 
            if($estado === "inactivo" || $estado === ""){
               
            
        ?>
        <a href="../Conexion/marcarTurnoEmpleado.php?estado=activo" class="btn btn-primary text-center"><i class="bx bx-timer" style="font-size:28px;"></i>Marcar Turno Activo</a>
    <?php 
            }
    ?>
    </div>
    <ul class="box-info">
        <h3>Horario y Dias de Trabajo</h3>
        <li>
            <i class='bx bx-time-five'></i>
            <span class="text">
                <h3><?=$horaInicio?></h3>
                <p>Hora Inicio</p>
            </span>
        </li>
        <li>
            <i class='bx bx-time-five'></i>
            <span class="text">
                <h3><?=$horaFin?></h3>
                <p>Hora fin</p>
            </span>
        </li>
        <li>
            <i class='bx bx-sun'></i>
            <span class="text">
                <h3><?=$dias?></h3>
                <p>Dias</p>
            </span>
        </li>
        

    </ul>
    <ul class="box-info">
        <h3>Tickets</h3>
        <li>
            <i class='bx bxs-file-archive'></i>
            <span class="text">
                <h3><?=$cerrados?></h3>
                <p> Cerrados</p>
            </span>
        </li>
       
        <li>
            <i class='bx bx-file'></i>
            <span class="text">
                <h3><?=$abiertos?></h3>
                <p> Abiertos</p>
            </span>
        </li>
    </ul>
    <ul class="box-info">
        <h3>Servicio Encargado</h3>
        <li>
            <i class='bx bx-wifi'></i>
            <span class="text">
                <h3><?=$infoEmpleado[0]["especialidad"]?></h3>
                
            </span>
        </li>
      

    </ul>
   


</main>