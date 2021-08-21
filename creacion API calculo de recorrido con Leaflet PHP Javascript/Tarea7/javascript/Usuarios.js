const selectModifUsuario = document.getElementById("modifUsuario");
selectModifUsuario.addEventListener("change", mostrarDatosUsuarioModif);

const selectBorrarUsuario = document.getElementById("borrUsuario");
selectBorrarUsuario.addEventListener("change", mostrarDatosUsuarioBorrar);

function mostrarDatosUsuarioModif() {
    let idUsuario = $('#modifUsuario').val();

    $.ajax({
        url: "DatosUsuario.php", 
        type: "post",
        data: {'idUsuario': idUsuario},
        success: function (response) {
            $("#mostrarDatosModif").html(response);
        },
        error: function () {
            alert("Ha habido un error.");
        }
    });

}

function mostrarDatosUsuarioBorrar() {
    let idUsuario = $('#borrUsuario').val();

    $.ajax({
        url: "DatosUsuario.php", 
        type: "post",
        data: {'idUsuario': idUsuario},
        success: function (response) {
            $("#mostrarDatosBorrar").html(response);
        },
        error: function () {
            alert("Ha habido un error.");
        }
    });

}
