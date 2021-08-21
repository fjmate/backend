/*Función para obtener sugerencias de las ciudades disponibles para obtener su hora*/
function sugerirCiudades(ciudad) {
    var parametros = {
        "ciudad": ciudad
    };
    $.ajax({
        data: parametros,
        url: 'sugerencias.php',
        type: 'post',
        success: function (response) {
            $("#sugerencias").html(response);
        }
    });
}
