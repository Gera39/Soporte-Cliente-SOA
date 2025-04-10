<?php
// modal.php



function mostrarModal($titulo, $cuerpo, $accion = null,$r = null) {
  if($accion){
    echo '<form action="../Controlador/'.$accion.'" method="POST">';
  }
  echo
    '
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">' . $titulo . '</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">';
          if($r){
            require("../../autenticacion.php");
            $client->setState($r);
            echo $cuerpo.'<a href="'.$client->createAuthUrl().'" class="btn btn-primary"><i class="bx bxl-google"></i>Iniciar con google</a></div>
            <div class="modal-footer">';

          }else {
            echo $cuerpo.'</div>
            <div class="modal-footer">';
          }

            
          
            if ($accion) {
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>' . "<button  type='submit' class='btn btn-primary'>Guardar</button>";

            } else {
                echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
            }
    echo   '</div>
        </div>
      </div>
    </div>';

    if($accion){
      echo '</form>';
    }
    
}


function actualizarModal($id,$name,$description,$costo){
  echo ' <form action="../Controlador/actualizarServicio.php" method="POST">
        
   
    <!-- Modal -->
    <div class="modal fade" id="actualizarModal'.$id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario dinámico -->
                    <form id="updateForm">
                        <div class="mb-3">
                            <label for="service-name" class="form-label">Nombre del Servicio</label>
                            <input type="text" class="form-control" id="service-name" name="nombre_servicio" value="'.$name.'" required>
                        </div>
                        <div class="mb-3">
                            <label for="service-description" class="form-label">Descripción</label>
                            <input class="form-control" id="service-description" name="descripcion" value="'.$description.'" rows="3"
                                required></input>
                        </div>
                        <div class="mb-3">
                            <label for="service-cost" class="form-label">Costo</label>
                            <input type="number" class="form-control" id="service-cost" name="costo" value="'.$costo.'" required>
                        </div>
                        <input type="hidden" id="service-id" name="id_servicio" value="'.$id.'">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="saveChangesBtn"  class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
     </form>
';
}

function mostrarServicio($id,$idCliente,$name,$description,$costo){
  echo ' <form action="../i.php" method="GET">
        
   
    <!-- Modal -->
    <div class="modal fade" id="actualizarModal'.$id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Servicio</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                        <div class="mb-3 text-center">
                        <strong>Nombre del Servicio</strong>
                            <input style="border:none; box-shadow: none;" type="text" class="form-control text-center" id="service-name" name="nombre_servicio" readonly value="'.$name.'" required>
                        </div>
                        <hr>
                        <div class="mb-3 text-center">
                           <strong>Descripción</strong>
                            <input style="border:none; box-shadow: none;" class="form-control text-center" id="service-description" name="descripcion" readonly value="'.$description.'" rows="3"
                                required></input>
                        </div>
                        <hr>
                        <div class="mb-3 text-center">
                        <strong>Costo</strong> 
                            <input style="border:none;  box-shadow: none;" type="text" class="form-control text-center" id="service-cost" name="costo" readonly value="$'.$costo.'MXN" required>
                        </div>
                        <input type="hidden" id="service-id" name="id_servicio" value="'.$id.'">
                        <input type="hidden" id="service-idCliente" name="id_cliente" value="'.$idCliente.'">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="saveChangesBtn"  class="btn btn-primary"><i class="bx bxs-shopping-bag-alt"></i> Ir a Comprar</button>
                </div>
            </div>
        </div>
    </div>
     </form>
';
}

function mostrarAviso($id){
  echo ' 
        
   
    <!-- Modal -->
    <div class="modal fade" id="actualizarModal'.$id.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel"><strong>AVISO</strong></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
            <i class="bx bxs-error-alt" style="color:#e51414; font-size:70px;" ></i>
                <h3>Servicio no puede ser contratado</h3>
                <p>El servicio seleccionado no puede ser contratado porque no cumple con los requisitos de contratación. <br>
                por favor llene su perfil de dirección</p>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
           
            </div>
          </div>
        </div>
    </div>
     
';
}
?>


