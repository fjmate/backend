window.addEventListener("load", Centro);

function Centro() {
    $.ajax({
        url: "../estructura/DatosCentro.php", 
        type: "post",
        success: function (response) {
            $("#mostrarDatos").html(response);
        },
        error: function () {
            alert("Ha habido un error.");
        }
    });

}


