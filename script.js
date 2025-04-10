document.addEventListener('DOMContentLoaded', function () {
    const servicio = document.getElementById('servicio').value;
    const idServicio = document.getElementById('id_servicio').value;
    const idCliente = document.getElementById('id_cliente').value;
    const descripcion = document.getElementById('descripcion').value;
    let costo = document.getElementById('costo').value;

    // Limpia el formato del costo (por ejemplo, $100 MXN -> 100)
    costo = costo.replace(/[^0-9.]/g, ''); 

    const selectedService = {
        idCliente,
        idServicio,
        servicio,
        descripcion,
        costo
    };

    if (selectedService.costo) {
        renderPayPalButton(selectedService);
    } else {
        console.error('El costo del servicio es inválido o está vacío');
    }

    function renderPayPalButton(service) {
        const paypalContainer = document.getElementById('paypal-button-container');
        paypalContainer.innerHTML = ''; // Limpia cualquier botón anterior

        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: service.costo, // Asegúrate de que sea un número válido
                            currency_code: 'MXN'
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    alert('Pago completado por ' + details.payer.name.given_name);

                    // Redirigir a archivo PHP con POST
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'Conexion/recibirPago.php'; // Cambia por el nombre de tu archivo PHP

                    const inputs = [
                        { name: 'id_cliente', value: service.idCliente },
                        { name: 'id_servicio', value: service.idServicio }
                        // Ejemplo: ID de la transacción de PayPal
                    ];

                    inputs.forEach(inputData => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = inputData.name;
                        input.value = inputData.value;
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit(); // Envía el formulario
                });
            },
            onError: function (err) {
                console.error('Error durante el proceso de pago:', err);
                alert('Hubo un problema con el pago. Intenta nuevamente.');
            }
        }).render('#paypal-button-container');
    }
});
