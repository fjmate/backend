window.addEventListener("load", ListadoUsuarios);
let idChecked = [];

let map = L.map('mapa').setView([37.36631992263872, -5.951622947505096], 14);
const control = L.Routing.control({

}).addTo(map);
L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function ListadoUsuarios() {
    $.ajax({
        url: "ListadoUsuarios.php", 
        type: "post",
        success: function (response) {
            $("#listaUsuarios").html(response);
            añadirPuntos();
        },
        error: function () {
            alert("Error.");
        }
    });
}

function añadirPuntos() {
    let btnRuta = document.getElementById('btnRecorrido');
    btnRuta.addEventListener("click", getRecorrido);
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", leerCheckboxSeleccionado);
    });
}

function leerCheckboxSeleccionado(event) {
    const checkbox = event.target;
    if (checkbox.checked) {
        idChecked.push(checkbox.value);
    } else {
        let indice = idChecked.indexOf(checkbox.value);
        if (indice != -1) {
            idChecked.splice(indice, 1);
        }
    }
}

function getRecorrido() {
    $.ajax({
        url: "getRecorrido.php", 
        type: "post",
        data: {'idChecked': idChecked},
        success: function (response) {
            const json = (response);
            calculaRuta(json);
        },
        error: function () {
            alert("Error. Elige a los usuarios a recoger.");
        }
    });
}

function calculaRuta(json) {
    let puntosRuta = [];

    for (let i in json) {
        let calle = json[i].direccion;
        let direccionCompleta = calle + '. Sevilla';

        $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + direccionCompleta, function (data) {
            let latitud = data[0].lat;
            let longitud = data[0].lon;

            let waypoint = L.latLng(latitud, longitud);
            
            puntosRuta.push(waypoint);
            L.marker(waypoint).bindPopup(calle);
            control.getPlan().setWaypoints(puntosRuta); 
            control.addTo(map);
            control.hide(); 
            
            let bounds = L.latLngBounds(puntosRuta);
            map.fitBounds(bounds);              
        });
    }
}

