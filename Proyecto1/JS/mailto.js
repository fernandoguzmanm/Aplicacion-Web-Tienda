function enviarMail() {
        var emailDestino = "fvieites@ucm.es";
        var nombre = document.getElementById("nombre").value;
        var motivo = document.querySelector('input[name="motivo"]:checked').value;
        var mensaje = document.getElementById("mensaje").value;

        var cuerpoMensaje = "Nombre: " + nombre + "\n\nMensaje:\n" + mensaje;
    
        var mailtoLink = "mailto:" + emailDestino +
                         "?subject=" + encodeURIComponent(motivo) +
                         "&body=" + encodeURIComponent(cuerpoMensaje);
    
        window.location.href = mailtoLink;
}
