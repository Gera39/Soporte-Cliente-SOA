<?php
	require_once ("../Conexion/ConsumoApi.php");
    require_once "../Conexion/Sesion.php";
	$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

    $username = Sesion::getUsername();
    $infoCliente = $apiClient->post("cliente",["username"=> $username]);


    Sesion::id($infoCliente[0]["id_cliente"]);

    Sesion::set("direccion",$infoCliente[0]["dirrecion"]);
    Sesion::set("cp",$infoCliente[0]["CP"]);
    Sesion::set("estado",$infoCliente[0]["Estado"]);
    $serviciosContratados = $apiClient->get("contratos/cliente/".$infoCliente[0]["id_cliente"]);
    Sesion::servicios($serviciosContratados);
    $tickets = $apiClient->post("tickets/cliente",["username"=> $username]);
    Sesion::tickets($tickets);
    $abiertos = 0;
    $cerrados = 0;
    $enProgreso = 0;
    foreach ($tickets as $ticket) {
        if ($ticket["estado"] === "Abierto") {
            $abiertos++;
        }else if($ticket["estado"] === "Cerrado" ){
            $cerrados++;
        }else if($ticket["estado"] === "En Progreso"){
            $enProgreso++;
        }
    }

?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Vista Rapida</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Cliente</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Vista Rapida</a>
                </li>
            </ul>
        </div>


    </div>

    <ul class="box-info">
        <li>

            <span class="text">
                <h3> Tickest</h3>

            </span>
        </li>
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
        <li>
            <i class='bx bx-file'></i>
            <span class="text">
                <h3><?=$enProgreso?></h3>
                <p> En Progreso</p>
            </span>
        </li>
    </ul>
    <ul class="box-info">
        <li>

            <span class="text">
                <h3>Servicios Contratados</h3>

            </span>
        </li>
        <?php
        $telefoniaContador = 0;
        $serviciosUnicos = [];
        foreach($serviciosContratados as $servicio){
            if($servicio["nombre_servicio"] == "Consultoria"){
            continue;
            }
            if($servicio["nombre_servicio"] == "Telefonia"){
            $telefoniaContador++;
            }
            if($servicio["nombre_servicio"] == "Telefonia" && $telefoniaContador > 1){
            continue;
            }
            if(!in_array($servicio["nombre_servicio"], $serviciosUnicos)){
            $serviciosUnicos[] = $servicio["nombre_servicio"];
            ?>
            <li>
                <i class='bx bx-wifi'></i>
                <span class="text">
                <h3><?=$servicio["nombre_servicio"]?></h3>
                </span>
            </li>
            <?php
            }
        }
        ?>
         
       


    </ul>



</main>