<?php

require_once ("../../Conexion/ConsumoApi.php");

require_once "../../Conexion/Sesion.php";

Sesion::startSesion();

// Verificar si el usuario está autenticado
if (!Sesion::estaAutenticado()) {
    header('Location: ../index.php?error=ip1');
    exit();
}

// Inicializar variables necesarias
$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");
$id = null;
$tickets = [];
$id_Ticket = null;
// $rol = null;
$idUsuario = null;
$username = Sesion::getUsername();

$ultimoCaracter = substr($username, -1);
switch ($ultimoCaracter) {
    case 'a':
       $endpoint = "admin";
       $value = "a";
       break;
    case 'e':
        $endpoint = "empleado";
        $value = "e";
        break;
    case 'c':
        $endpoint = "cliente";
        $value = "c";
        break;
    
}


// Verificar el rol del usuario
if ( $value === "c") { // Cliente
   $rol = "Cliente";    
    //se modifica el apiClient para que solo se devuelva el cliente 
    $clienteEncontrado = $apiClient->post("cliente",["username"=>$username]);
    
    // foreach ($clientes as $cliente) {
    //     if ($cliente['username'] === Sesion::getUsername()) {
    //         $id = $cliente['id_cliente'];
    //         $idUsuario = $cliente['id_persona'];
    //         break;
    //     }
    // }
    $idUsuario = $clienteEncontrado[0]['id_persona'];
    $id = $clienteEncontrado[0]["id_cliente"];
    if ($id !== null) {
        $tickets = $apiClient->get("tickets/cliente/$id");
    } else {
        die("Error: Cliente no encontrado.");
    }

    
} else { // Empleado
    $rol = "Empleado";
    $empleadoEncontrado = $apiClient->post("empleado",["username"=>$username]);

    // foreach ($empleados as $empleado) {
    //     if ($empleado['username'] === Sesion::getUsername()) {
    //         $id = $empleado['id_empleado'];
    //         $idUsuario = $empleado['id_persona'];
    //         break;
    //     }
    // }
    $idUsuario = $empleadoEncontrado[0]['id_persona'];
    $id = $empleadoEncontrado[0]["id_empleado"];
    if ($id !== null) {
        $tickets = $apiClient->get("tickets/empleado/$id");
    } else {
        die("Error: Empleado no encontrado.");
    }
}
function mostrarConversacion($idTicket)
{
    global $apiClient;
    $mensajes = $apiClient->get("mensajes/ticket/$idTicket");
    foreach ($mensajes as $mensaje) {
        $lado = ($mensaje['username'] === Sesion::getUsername()) ? 'derecha' : 'izquierda';
        echo "<div class='mensaje $lado'>";
        echo "<p>" . htmlspecialchars($mensaje['mensaje']) . "</p>";
        if (!empty($mensaje['url_archivo'])) {
            echo "<a href='" . htmlspecialchars($mensaje['url_archivo']) . "' target='_blank'>Archivo adjunto</a>";
        }
        echo "</div>";
    }
}
?>

<main id="mainChat">
    <div class="head-title">
        <div class="left">
            <h1>Mensajes</h1>
            <ul class="breadcrumb">
                <li><a href="#"><?=$endpoint?></a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Mensajes</a></li>
            </ul>
        </div>
    </div>

    <div id="chat">
        <section id="tickets">
            <?php if (empty($tickets)): ?>
                <p>No tiene Tickets Abiertos</p>
            <?php else: ?>
                <ul class="side-menu top">
                    <?php foreach ($tickets as $ticket): ?>
                        <?php if ($ticket['estado'] != "Cerrado"):
                            $id_Ticket = htmlspecialchars($ticket['id_ticket']);
                           

                            // Convertimos el objeto PHP a JSON para usarlo en JavaScript
                            $objectTicket = $ticket;
                            if ($objectTicket['estado'] == 'Abierto') {
                                $objectTicket['estado'] = 'En Progreso';
                            }
                            $objectTicketJson = htmlspecialchars(json_encode($objectTicket), ENT_QUOTES, 'UTF-8'); ?>

                            <li>
                                <a href="#" onclick="iniciarChat(<?php echo $id_Ticket; ?>, '<?php echo $username; ?>'); 
                                 actualizarTicket(<?php echo $objectTicketJson; ?>);">
                                    <i class='bx bx-message-dots' style='color:#0f5cd7'></i>
                                    <span class="text">
                                        <?php echo htmlspecialchars($ticket['nombre_servicio'] . ": " . $ticket['fecha_creacion']); ?>
                                    </span>
                                </a>
                            
                            </li>

                            <br>

                            <?php
                            $objectTicket['estado'] = 'Cerrado';
                            $objectTicketJson2 = htmlspecialchars(json_encode($objectTicket), ENT_QUOTES, 'UTF-8');
                            if ($rol == 'Cliente'): ?>
                                <ul class="side-menu">
                                    <li>
                                        <form action="layouts/encuesta.php" method="POST" onsubmit="<?php $apiClient->put('update-ticket', $objectTicket) ?>">
                                            <?php foreach ($objectTicket as $key => $value): ?>
                                                <input type="hidden" name="ticket[<?php echo $key; ?>]" value="<?php echo $value; ?>">
                                            <?php endforeach; ?>

                                            <button class="btn btn-primary btn-sm px-3" type="submit"
                                                onclick="<?php $apiClient->put('update-ticket', $objectTicket) ?>">Cerrar
                                                Ticket</button>
                                        </form>
                                    </li>
                                </ul>
                                <br>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <section id="conversacion">
            <section id="mensajes"> <!-- Mensajes se mostrarán aquí --> </section>
            <section id="botonesMensajes">
                <input type="text" placeholder="Escribe tu mensaje aquí" id="msj" name="msj">
                <button
                    onclick="enviarMensaje(<?php echo htmlspecialchars($id_Ticket) ?>, <?php echo htmlspecialchars($idUsuario) ?>, 'msj', '<?php echo htmlspecialchars(Sesion::getUsername()); ?>');"
                    id="enviarBtn">Enviar</button>
            </section>
        </section>
    </div>
</main>