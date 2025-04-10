<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=AaOUjZ1Vgii8kvJjG5c93Ao66uZwjqjIVCZg7X5_4p2BOSsZiFYgF4DMk3geBWiW2RSA14QbRfTa6MSj&currency=MXN"></script>
    <script src="script.js" defer></script>
    <style>
        .form-container {
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <?php
     require_once "Conexion/Sesion.php";
     $idCliente = Sesion::getId();  
    if (!empty($_GET)) {
     $idServicio = $_GET["id_servicio"];

        $nombreServicio = $_GET["nombre_servicio"];
        $descripcionServicio = $_GET["descripcion"];
        $costoServicio = $_GET["costo"];
    } else {
        header("Location: dashboard/dashboardCliente.php?error=datos");
        exit();
    }
    ?>

    <!-- Contenedor principal -->
    <div class="form-container p-4 border rounded bg-white shadow-sm">
        <h1 class="text-center mb-4">Contratación de Servicios</h1>
        
        <form id="payment-form">
            <!-- Selección de servicio -->
            <div class="mb-3">
                <label for="servicio" class="form-label">Servicio:</label>
                <input id="servicio" type="text" name="servicio" class="form-control" readonly value="<?=$nombreServicio?>"/> 
            </div>

            <!-- Descripción del servicio -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" value="<?=$descripcionServicio?>" class="form-control" readonly>
            </div>

            <!-- Costo del servicio -->
            <div class="mb-3">
                <label for="costo" class="form-label">Costo:</label>
                <input type="text" id="costo" name="costo" value="<?=$costoServicio?>" class="form-control" readonly>
            </div>
            <input type="hidden" id="id_servicio" name="id_servicio" value="<?=$idServicio?>">
            <input type="hidden" id="id_cliente" name="id_cliente" value="<?=$idCliente?>">
            <!-- Contenedor de PayPal centrado -->
            <div id="paypal-button-container" class="d-flex justify-content-center mt-4"></div>
        </form>
    </div>

    <!-- Agregar script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
