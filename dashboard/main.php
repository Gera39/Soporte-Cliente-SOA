<?php
	require_once ("../Conexion/ConsumoApi.php");
	$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

	$empleados = $apiClient->get("empleados");
    
	$clientes = $apiClient->get("clientes");
	$costos = $apiClient->get("costos");

	$cantidadEmpleados = count($empleados);
	$cantidadClientes = count($clientes);



?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Vista Rapida</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Adminitrador</a>
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
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3><?=$cantidadClientes?></h3>
                <p>Clientes</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-group'></i>
            <span class="text">
                <h3><?=$cantidadEmpleados?></h3>
                <p>Empleados</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-dollar-circle'></i>
            <span class="text">
                <h3>$<?=$costos[0]["total"]?></h3>
                <p>Total de Servicios Contratados</p>
            </span>
        </li>
    </ul>
    <ul class="box-info">
        <li>
            <i class='bx bx-wifi'></i>
            <span class="text">
                <h3><?=$costos[0]["totalInternet"]?></h3>
                <p>Internet Ganancias</p>
            </span>
        </li>
        <li>
            <i class='bx bx-wifi'></i>
            <span class="text">
                <h3><?=$costos[0]["cantidadInternet"]?></h3>
                <p>Cantidad Contratados</p>
            </span>
        </li>

    </ul>
    <ul class="box-info">
        <li>
            <i class='bx bx-phone-call'></i>
            <span class="text">
                <h3><?=$costos[0]["totalOtros"]?></h3>
                <p>Telefonia Ganancias</p>
            </span>
        </li>
        <li>
            <i class='bx bx-phone-call'></i>
            <span class="text">
                <h3><?=$costos[0]["cantidadOtros"]?></h3>
                <p>Cantidad contratados</p>
            </span>
        </li>

    </ul>


</main>