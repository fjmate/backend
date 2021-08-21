window.addEventListener("load", getDatosCentro);

function getDatosCentro() {
    $.ajax({
        url: "getDatosCentro.php", 
        type: "post",
        success: function (response) {
            const json = (response);
            dibujaMapa(json);
        },
        error: function () {
            alert("Ha habido un error.");
        }
    });
}

function dibujaMapa(json) {
    let calle = json[0].direccion;
    let titulo = "Mi centro";
    let direccionCompleta = calle + '. Sevilla . Sevilla';

    $.get(location.protocol + '//nominatim.openstreetmap.org/search?format=json&q=' + direccionCompleta, function (data) {
        let latitud =  37.36631992263872;
        let longitud =  -5.951622947505096;

        const tilesProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        let map = L.map('mapa').setView([latitud, longitud], 15);
        L.tileLayer(tilesProvider, {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors</a>',
            maxZoom: 18,
        }).addTo(map);

        let iconoCentro = new L.Icon({
            iconUrl: '../img/icono.png',
            iconSize: [26, 50],
            iconAnchor: [13, 60],
            popupAnchor: [-3, -60]
        });

        const marcadorCentro = L.marker([latitud, longitud], {icon: iconoCentro}).addTo(map);

        marcadorCentro.bindPopup(titulo).openPopup();
    });
}