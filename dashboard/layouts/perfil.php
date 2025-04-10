<?php
	require_once(__DIR__ . "/../../Conexion/ConsumoApi.php");
	$apiClient = new DatabaseApiClient("https://apicomi.codetrail.store/api");

	require_once (__DIR__ . "/../../Conexion/Sesion.php");


	Sesion::startSesion();
	if (!Sesion::estaAutenticado()) {
		// Si no está autenticado, redirigir al login
		header('Location: ../index.php?error=ip1');
		exit();
	}
	$username = Sesion::getUsername();
   
    $endpoint = "";
    $value = "";
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
    





	$resultado = $apiClient->post($endpoint,["username"=> $username]);
	?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Perfil</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#"><?= $endpoint?></a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Perfil</a>
                </li>
            </ul>
        </div>

        <?php 
						if($endpoint == "admin"){
							
							require_once "../modal.php";
							
							
							// Mostramos el modal
							mostrarModal("Insertar Nuevo Administrador", '

                                <i class="bx bx-user" style="font-size:90px;"></i>
								<div class="form-group p-3">
									<input type="text" class="form-control custom-input" placeholder="Nombre" name="nombre" required>
								</div>
								<div class="form-group p-3">
									<input type="text" class="form-control custom-input" placeholder="Apellido" name="apellido" required>
								</div>
								<div class="form-group p-3">
									<input type="email" class="form-control custom-input" placeholder="Correo" name="correo" required>
								</div>
								<div class="form-group p-3">
									<input type="tel" class="form-control custom-input" placeholder="Teléfono" name="telefono" required>
								</div>
								
								<div class="form-group p-3">
									<input type="password" class="form-control custom-input" placeholder="Contraseña" id="contrasena" name="password" required>
								</div>
								<div class="form-group p-3">
									<input type="password" class="form-control custom-input" placeholder="Confirmar Contraseña" id="contrasenaV" required>
								</div>
								<input type="hidden" name="rol" value="a">
							', 'LoginControlador.php','a');

                        
							?>






   

    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        <span class="text"><i class='bx bx-plus'></i>Adminitrador</span>
    </a>
    <?php 
        }
        ?>
         </div>

    <i class="bx bx-user" style="font-size:150px;"></i> <!-- Tamaño 3 veces más grande -->
    
    
    <form action="../Controlador/LoginControlador.php?accion=actualizarPerfil" method="POST">


        <div class="form-group p-3">
            <input type="text" class="form-control custom-input" value="<?= $resultado[0]["nombre"]?>"
                placeholder="Nombre" name="nombre" required>
        </div>
        <div class="form-group p-3">
            <input type="text" class="form-control custom-input" value="<?= $resultado[0]["apellido"]?>"
                placeholder="Apellido" name="apellido" required>
        </div>
        <div class="form-group p-3">
            <input type="email" class="form-control custom-input" value="<?= $resultado[0]["correo"]?>"
                placeholder="Correo" name="correo" required>
        </div>
        <div class="form-group p-3">
            <input type="tel" class="form-control custom-input" value="<?= $resultado[0]["telefono"]?>"
                placeholder="Teléfono" name="telefono" required>
        </div>
        
       
        <div class="form-group p-3">
        <button class="btn btn-primary" onclick="obtenerUbicacionUsuario()">Obtener Ubicación  <i class='bx bx-world' style="font-size:20px;"></i></button>
            <input type="text" class="form-control custom-input" value="<?= $resultado[0]["dirrecion"]?>"
                placeholder="Dirección" id="direccion" name="direccion" required>
        </div>
        <div class="form-group p-3">
            <input type="text" class="form-control custom-input" value="<?= $resultado[0]["Estado"]?>"
                placeholder="Municipio" id="estado" name="estado" required>
        </div>
        <div class="form-group p-3">
            <input type="text" class="form-control custom-input" value="<?= $resultado[0]["CP"]?>"
                placeholder="Código Postal" id="cp" name="cp" required>
        </div>
        <div class="form-group p-3">
            <input type="password" class="form-control custom-input" placeholder="Nueva contraseña" id="contrasena"
                name="password" required>
        </div>
        <input type="hidden" name="rol" value="<?= $value?>">
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-sm px-3">Guardar</button>
            <button type="reset" class="btn btn-secondary btn-sm px-3">Cancelar</button>
        </div>

    </form>

   




</main>