<?php
require_once ("../../Conexion/ConsumoApi.php");
require_once "../../Conexion/Sesion.php";

Sesion::startSesion();

// Obtener el ticket_id de los parámetros de la URL

$ticket = $_POST['ticket'];
$ticket['estado'] = 'Cerrado';
$objectTicketJson = htmlspecialchars(json_encode($ticket), ENT_QUOTES, 'UTF-8');
print_r($objectTicketJson);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuesta de Soporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Styles/styles.css">
    <script src="../../JavaScript/jsChat.js"></script>
</head>

<body>
    <script>
        actualizarTicket(<?php echo $objectTicketJson ?>);
    </script>
    <section class="content">
        <h1>Encuesta Satisfacción con el soporte técnico</h1>
        <p>Hola, <br> Por favor, invierta unos pocos minutos de su tiempo para rellenar el siguiente cuestionario</p>
        <div class="encuesta-definitiva">
            <form action="../dashboardCliente.php" id="formEncuesta">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                <div class="group">
                    <section>
                        <div class="sizer">
                            <h2>1.¿Cuándo fua la última vez que contactaste con atencion al cliente de nuestra compañía?
                            </h2>
                            <br>
                            <div class="answer">
                                <div class="list">
                                    <ul class="respuestas">
                                        <label for="p-r1" onfocus="color(this)">
                                            <input name="pregunta_1" type="radio" value="8" id="p-r1">
                                            < 3 meses </label>
                                                <label for="p-r2">
                                                    <input name="pregunta_1" type="radio" value="8" id="p-r2"> 3-6 meses
                                                </label>
                                                <label for="p-r3">
                                                    <input name="pregunta_1" type="radio" value="8" id="p-r3"> 6-12
                                                    meses
                                                </label>
                                                <label for="p-r4">
                                                    <input name="pregunta_1" type="radio" value="8" id="p-r4"> +12 meses
                                                </label>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="group">
                    <section>
                        <div class="sizer">
                            <h2>2. Por favor, evalúa tu satisfacción general con el servicio de soporte.</h2>
                            <br>
                            <div class="answer">
                                <div class="list">
                                    <ul class="respuestas">
                                        <label for="p2-r1">
                                            <input name="pregunta_2" type="radio" value="10" id="p2-r1"> Muy contento
                                        </label>
                                        <label for="p2-r2">
                                            <input name="pregunta_2" type="radio" value="8" id="p2-r2"> Contento
                                        </label>
                                        <label for="p2-r3">
                                            <input name="pregunta_2" type="radio" value="6" id="p2-r3"> Ni contento, ni
                                            descontento
                                        </label>
                                        <label for="p2-r4">
                                            <input name="pregunta_2" type="radio" value="4" id="p2-r4"> Descontento
                                        </label>
                                        <label for="p2-r5">
                                            <input name="pregunta_2" type="radio" value="2" id="p2-r5"> Muy Descontento
                                        </label>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="group">
                    <section>
                        <div class="sizer">
                            <h2>3.-Basado en tu experiencia, por favor evalúa tu grado de satisfacción con el servicio
                                de soporte:</h2>
                            <br>
                            <div class="answers">
                                <div class="list" id="p3">
                                    <div class="row">
                                        <h3>Problema resuelto</h3>
                                        <br>
                                        <ul class="respuestas ">
                                            <label for="p3-r1">
                                                <input name="problemaR" type="radio" value="10" id="p3-r1"> Muy contento
                                            </label>
                                            <label for="p3-r2">
                                                <input name="problemaR" type="radio" value="8" id="p3-r2"> Contento
                                            </label>
                                            <label for="p3-r3">
                                                <input name="problemaR" type="radio" value="6" id="p3-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p3-r4">
                                                <input name="problemaR" type="radio" value="4" id="p3-r4"> Descontento
                                            </label>
                                            <label for="p3-r5">
                                                <input name="problemaR" type="radio" value="2" id="p3-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Calidad de consejos</h3>
                                        <br>
                                        <ul class="respuestas">
                                            <label for="p4-r1">
                                                <input name="calidadC" type="radio" value="10" id="p4-r1"> Muy contento
                                            </label>
                                            <label for="p4-r2">
                                                <input name="calidadC" type="radio" value="8" id="p4-r2"> Contento
                                            </label>
                                            <label for="p4-r3">
                                                <input name="calidadC" type="radio" value="6" id="p4-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p4-r4">
                                                <input name="calidadC" type="radio" value="4" id="p4-r4"> Descontento
                                            </label>
                                            <label for="p4-r5">
                                                <input name="calidadC" type="radio" value="2" id="p4-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Rapidez en responder</h3>
                                        <br>
                                        <ul class="respuestas">
                                            <label for="p5-r1">
                                                <input name="rapidezR" type="radio" value="10" id="p5-r1"> Muy contento
                                            </label>
                                            <label for="p5-r2">
                                                <input name="rapidezR" type="radio" value="8" id="p5-r2"> Contento
                                            </label>
                                            <label for="p5-r3">
                                                <input name="rapidezR" type="radio" value="6" id="p5-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p5-r4">
                                                <input name="rapidezR" type="radio" value="4" id="p5-r4"> Descontento
                                            </label>
                                            <label for="p5-r5">
                                                <input name="rapidezR" type="radio" value="2" id="p5-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Profesionalidad del representante</h3>
                                        <ul class="respuestas">
                                            <label for="p6-r1">
                                                <input name="profesionalidad" type="radio" value="10" id="p6-r1"> Muy
                                                contento
                                            </label>
                                            <label for="p6-r2">
                                                <input name="profesionalidad" type="radio" value="8" id="p6-r2">
                                                Contento
                                            </label>
                                            <label for="p6-r3">
                                                <input name="profesionalidad" type="radio" value="6" id="p6-r3"> Ni
                                                contento, ni descontento
                                            </label>
                                            <label for="p6-r4">
                                                <input name="profesionalidad" type="radio" value="4" id="p6-r4">
                                                Descontento
                                            </label>
                                            <label for="p6-r5">
                                                <input name="profesionalidad" type="radio" value="2" id="p6-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Voluntad a ayudar</h3>
                                        <ul class="respuestas">
                                            <label for="p7-r1">
                                                <input name="voluntadA" type="radio" value="10" id="p7-r1"> Muy contento
                                            </label>
                                            <label for="p7-r2">
                                                <input name="voluntadA" type="radio" value="8" id="p7-r2"> Contento
                                            </label>
                                            <label for="p7-r3">
                                                <input name="voluntadA" type="radio" value="6" id="p7-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p7-r4">
                                                <input name="voluntadA" type="radio" value="4" id="p7-r4"> Descontento
                                            </label>
                                            <label for="p7-r5">
                                                <input name="voluntadA" type="radio" value="2" id="p7-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Facilidad de contactar con el soporte</h3>
                                        <ul class="respuestas">

                                            <label for="p8-r1">
                                                <input name="facilidadC" type="radio" value="10" id="p8-r1"> Muy
                                                contento
                                            </label>
                                            <label for="p8-r2">
                                                <input name="facilidadC" type="radio" value="8" id="p8-r2"> Contento
                                            </label>
                                            <label for="p8-r3">
                                                <input name="facilidadC" type="radio" value="6" id="p8-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p8-r4">
                                                <input name="facilidadC" type="radio" value="4" id="p8-r4"> Descontento
                                            </label>
                                            <label for="p8-r5">
                                                <input name="facilidadC" type="radio" value="2" id="p8-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="group">
                    <section>
                        <div class="sizer">
                            <h2>4.-Por favor, evalúa los siguientes enunciados según tu experiencia:</h2>
                            <br>
                            <div class="answers">
                                <div class="list" id="p9">
                                    <div class="row">
                                        <h3>Se vio que el representante fue un experto</h3>
                                        <br>
                                        <ul class="respuestas">
                                            <label for="p10-r1">
                                                <input name="experto" type="radio" value="10" id="p10-r1"> Muy contento
                                            </label>
                                            <label for="p10-r2">
                                                <input name="experto" type="radio" value="8" id="p10-r2"> Contento
                                            </label>
                                            <label for="p10-r3">
                                                <input name="experto" type="radio" value="6" id="p10-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p10-r4">
                                                <input name="experto" type="radio" value="4" id="p10-r4"> Descontento
                                            </label>
                                            <label for="10-r5">
                                                <input name="experto" type="radio" value="2" id="p10-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>El representante fue paciente</h3>
                                        <br>
                                        <ul class="respuestas">
                                            <label for="p11-r1">
                                                <input name="paciente" type="radio" value="10" id="p11-r1"> Muy contento
                                            </label>
                                            <label for="p11-r2">
                                                <input name="paciente" type="radio" value="8" id="p11-r2"> Contento
                                            </label>
                                            <label for="p11-r3">
                                                <input name="paciente" type="radio" value="6" id="p11-r3"> Ni contento,
                                                ni descontento
                                            </label>
                                            <label for="p11-r4">
                                                <input name="paciente" type="radio" value="4" id="p11-r4"> Descontento
                                            </label>
                                            <label for="p11-r5">
                                                <input name="paciente" type="radio" value="2" id="p11-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>Me escucho atentamente</h3>
                                        <br>
                                        <ul class="respuestas">
                                            <label for="p12-r1">
                                                <input name="atento" type="radio" value="10" id="p12-r1"> Muy contento
                                            </label>
                                            <label for="p12-r2">
                                                <input name="atento" type="radio" value="8" id="p12-r2"> Contento
                                            </label>
                                            <label for="p12-r3">
                                                <input name="atento" type="radio" value="6" id="p12-r3"> Ni contento, ni
                                                descontento
                                            </label>
                                            <label for="p12-r4">
                                                <input name="atento" type="radio" value="4" id="p12-r4"> Descontento
                                            </label>
                                            <label for="p12-r5">
                                                <input name="atento" type="radio" value="2" id="p12-r5"> Muy Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>El representante fue amable</h3>
                                        <ul class="respuestas">
                                            <label for="p13-r1">
                                                <input name="amable" type="radio" value="10" id="p13-r1"> Muy contento
                                            </label>
                                            <label for="p13-r2">
                                                <input name="amable" type="radio" value="8" id="p13-r2"> Contento
                                            </label>
                                            <label for="p13-r3">
                                                <input name="amable" type="radio" value="6" id="p13-r3"> Ni contento, ni
                                                descontento
                                            </label>
                                            <label for="p13-r4">
                                                <input name="amable" type="radio" value="4" id="p13-r4"> Descontento
                                            </label>
                                            <label for="p13-r5">
                                                <input name="amable" type="radio" value="2" id="p13-r5"> Muy Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>El representante fue comprensivo</h3>
                                        <ul class="respuestas">
                                            <label for="p14-r1">
                                                <input name="compresivo" type="radio" value="10" id="p14-r1"> Muy
                                                contento
                                            </label>
                                            <label for="p14-r2">
                                                <input name="compresivo" type="radio" value="8" id="p14-r2"> Contento
                                            </label>
                                            <label for="p14-r3">
                                                <input name="compresivo" type="radio" value="6" id="p14-r3"> Ni
                                                contento, ni descontento
                                            </label>
                                            <label for="p14-r4">
                                                <input name="compresivo" type="radio" value="4" id="p14-r4"> Descontento
                                            </label>
                                            <label for="p14-r5">
                                                <input name="compresivo" type="radio" value="2" id="p14-r5"> Muy
                                                Descontento
                                            </label>
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <h3>El representante fue cortés</h3>
                                        <ul class="respuestas">

                                            <label for="p15-r1">
                                                <input name="cortes" type="radio" value="10" id="p15-r1"> Muy contento
                                            </label>
                                            <label for="p15-r2">
                                                <input name="cortes" type="radio" value="8" id="p15-r2"> Contento
                                            </label>
                                            <label for="p15-r3">
                                                <input name="cortes" type="radio" value="6" id="p15-r3"> Ni contento, ni
                                                descontento
                                            </label>
                                            <label for="p15-r4">
                                                <input name="cortes" type="radio" value="4" id="p15-r4"> Descontento
                                            </label>
                                            <label for="p15-r5">
                                                <input name="cortes" type="radio" value="2" id="p15-r5"> Muy Descontento
                                            </label>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <button name="enviar" class="btn btn-warning" type="submit" id="enviar">Enviar</button>
            </form>
        </div>


    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Definir average como variable global
        let average = 0;

        document.getElementById('formEncuesta').addEventListener('submit', function (event) {
            // Evitar el envío inmediato del formulario
            event.preventDefault();

            let isValid = true;
            let totalScore = 0; // Para almacenar la suma de las respuestas
            let answeredQuestions = 0; // Para contar cuántas preguntas se han respondido

            const questions = [
                'pregunta_1', 'pregunta_2', 'problemaR', 'calidadC', 'rapidezR', 'profesionalidad',
                'voluntadA', 'facilidadC', 'experto', 'paciente', 'atento', 'amable', 'compresivo', 'cortes'
            ];
            const unansweredQuestions = [];

            // Recorre cada pregunta
            questions.forEach(name => {
                const selectedOption = document.querySelector(`input[name="${name}"]:checked`);

                // Si no se ha seleccionado una opción
                if (!selectedOption) {
                    unansweredQuestions.push(name);
                    isValid = false;
                } else {
                    // Sumar la respuesta seleccionada (el valor del radio button)
                    totalScore += parseInt(selectedOption.value);
                    answeredQuestions++; // Aumentar el contador de preguntas respondidas
                }
            });

            // Si alguna pregunta no ha sido respondida, mostrar un error
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, conteste todas las preguntas.',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                // Calcular el promedio
                average = totalScore / answeredQuestions; // Establecer average como global
                console.log("Promedio de las respuestas:", average);

                // Crear un objeto con los datos a enviar
                const datos = {
                    id_ticket: <?php echo json_encode($ticket['id_ticket']); ?>,
                    id_empleado: <?php echo json_encode($ticket['id_empleado']); ?>,
                    id_cliente: <?php echo json_encode($ticket['id_cliente']); ?>,
                    calificacion: average, // Calificación numérica
                    comentario: '' // Comentario limpio de espacios adicionales
                };

                // Enviar los datos usando fetch o XMLHttpRequest
                fetch('https://apicomi.codetrail.store/api/insert-calificacion', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(datos)
                }).then(response => response.json())
                    .then(data => {
                        console.log(data);
                        // Enviar el formulario manualmente después de la respuesta de la API
                        event.target.submit();
                    })
                    .catch(error => console.error('Error:', error));
            }
            actualizarTicket(<?php echo json_encode($objectTicketJson); ?>);
        });
    </script>
</body>

</html>