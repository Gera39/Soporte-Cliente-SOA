let idTicketActivo = null; // Para rastrear el ticket activo

function iniciarChat(idTicket, username) {
    const mensajesDiv = document.getElementById('mensajes');

    if (idTicketActivo === idTicket) {
        return;
    }

    idTicketActivo = idTicket;

    cargarMensajes(idTicket, username);

    setInterval(() => {
        if (idTicketActivo === idTicket) { // Solo actualizar si el ticket es el activo
            cargarMensajes(idTicket, username);
        }
    }, 3000);
}

function cargarMensajes(idTicket, username) {
    const currentUsername = username;
    const mensajesDiv = document.getElementById('mensajes');

    fetch(`https://apicomi.codetrail.store/api/mensajes/ticket/${idTicket}`)
        .then(response => response.json())
        .then(data => {
            const mensajesActuales = mensajesDiv.querySelectorAll('.mensaje');
            if (mensajesActuales.length === data.length) {
                // No recargar si el número de mensajes no ha cambiado
                return;
            }

            mensajesDiv.innerHTML = ''; // Limpia solo si hay nuevos mensajes
            data.forEach(mensaje => {
                const mensajeDiv = document.createElement('div');
                mensajeDiv.classList.add(
                    'mensaje',
                    mensaje.username === currentUsername ? 'derecha' : 'izquierda'
                );
                mensajeDiv.innerHTML = `<p>${mensaje.mensaje}</p>`;
                if (mensaje.url_archivo) {
                    mensajeDiv.innerHTML += `<a href="${mensaje.url_archivo}" target="_blank">Archivo adjunto</a>`;
                }
                mensajesDiv.appendChild(mensajeDiv);
            });
            mensajesDiv.scrollTop = mensajesDiv.scrollHeight; // Auto-scroll hacia el final
        })
        .catch(error => {
            console.error("Error al cargar mensajes:", error);
            mensajesDiv.innerHTML = '<p>Error al cargar mensajes.</p>';
        });
}


function enviarMensaje(idTicket, idUsuario, inputId, username) {
    const mensajeInput = document.getElementById(inputId);
    const mensaje = mensajeInput.value.trim();

    if (!mensaje) {
        alert("El mensaje no puede estar vacío.");
        return;
    }

    const datos = {
        id_ticket: idTicket,
        id_usuario: idUsuario,
        mensaje: mensaje,
    };

    fetch('https://apicomi.codetrail.store/api/insert-mensaje', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar el mensaje.");
            }
            return response.json();
        })
        .then(data => {
            mensajeInput.value = ""; // Limpia el campo de texto
            cargarMensajes(idTicket, username); // Actualiza la conversación
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un problema al enviar el mensaje.");
        });
}

async function actualizarTicket(ticketData) {
    const url = "https://apicomi.codetrail.store/api/update-ticket";

    try {
        const response = await fetch(url, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(ticketData)
        });

        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status} - ${response.statusText}`);
        }

        const data = await response.json();
        console.log("Ticket actualizado con éxito:", data);
    } catch (error) {
        console.error("Error completo de la solicitud:", error);
        alert("Error al actualizar el ticket: " + error.message);
    }
}

function enviarCalificacion(idTicket, idEmpleado, idCliente, calificacion, comentario) {

    const datos = {
        id_ticket: idTicket,
        id_empleado: idEmpleado,
        id_cliente: idCliente,
        calificacion: calificacion, // Calificación numérica
        comentario: comentario.trim() // Comentario limpio de espacios adicionales
    };

    fetch('https://apicomi.codetrail.store/api/insert-calificacion', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar la calificación.");
            }
            return response.json();
        })
        .then(data => {
            console.log("Calificación enviada con éxito:", data);
            Swal.fire({
                icon: 'success',
                title: 'Exito',
                text: '¡Gracias por tu calificación!',
                confirmButtonText: 'Aceptar'
            });
        })
        .catch(error => {
            console.error("Error:" + error);
            alert("Hubo un problema al enviar la calificación." + error);
            throw error;
        });
}

