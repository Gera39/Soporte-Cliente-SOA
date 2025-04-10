<?php
require_once "../Controlador/LoginControlador.php";
require_once "../Conexion/Sesion.php";



Sesion::startSesion();
if (!Sesion::estaAutenticado()) {
    // Si no está autenticado, redirigir al login
    header('Location: ../index.php?error=ip1');
    exit();
}
$username = Sesion::getUsername();




?>

<?php 
	require_once "header.php";
	$pagina = "mainCliente.php";
?>
<body>


	
	<!-- SIDEBAR -->
        <section id="sidebar">
            <a href="#" class="brand">
                <i class='bx bxs-package' style='color:#0f5cd7'></i>
                <span class="text">CodeTrail</span>
            </a>
            <ul class="side-menu top">
                <li class="active">
                    <a href="#" onclick="loadContent('mainCliente.php')">
                        <i class='bx bxs-dashboard '  style='color:#0f5cd7'></i>
                        <span class="text">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadContent('layouts/ticketCliente.php')">
                    <i class='bx bxs-briefcase' style='color:#0f5cd7'  ></i>
                        <span class="text">Tickets</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadContent('layouts/serviciosCliente.php')">
                    <i class='bx bx-server' style='color:#0f5cd7' ></i>
                        <span class="text">Servicios</span>
                    </a>
                </li>
                <li>
                    <a href="#" onclick="loadContent('layouts/chat.php')">
                    <i class='bx bxs-report' style='color:#0f5cd7' ></i>
                        <span class="text">Mensajes</span>
                    </a>
                </li>
                
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="#" onclick="loadContent('layouts/perfil.php')">
                        <i class='bx bxs-user'></i>
                        <span class="text">Perfil</span>
                    </a>
                </li>
                <li>
                    <a href="../Conexion/logout.php" class="logout">
                        <i class='bx bxs-log-out-circle'></i>
                        <span class="text">Logout</span>
                    </a>
                </li>
               
               
            </ul>
        </section>

	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Cliente</a>
			<form action="#">
				<div class="form-input" style="display:none;">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			Modo nocturno<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
          <!-- El contenido se cargará aquí con AJAX -->
          <div class="loader-section">
                  <div class="loader"></div>
        </div>
		<div id="main-content">
           
  
            <?php
                // Cargar el contenido por defecto si no hay página seleccionada
                $pagina = isset($_GET['page']) ? $_GET['page'] : 'mainCliente.php';
                include($pagina);
            ?>
        </div>
		<!-- MAIN -->
	<?php require_once "footer.php";?>
