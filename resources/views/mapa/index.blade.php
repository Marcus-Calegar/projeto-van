<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        /* Define o tamanho do mapa */
        #map {
            height: 100vh;
            /* Ocupa toda a altura da tela */
            width: 100%;
            /* Ocupa 100% da largura */
        }
    </style>
</head>

<body>
    <button>
        <a href="dashboard">Voltar</a>
    </button>

    <!-- Div que vai conter o mapa -->
    <div id="map"></div>

    <script>
        let map;

        async function initMap() {
            const {
                Map
            } = await google.maps.importLibrary("maps");

            map = new Map(document.getElementById("map"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
            });
        }

        initMap();
    </script>

    <!-- Carrega a API do Google Maps com sua API_KEY -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCbGVDb5FPs9cR0uFcFGFdQiK8jp5RLJc&callback=initMap">
    </script>
</body>

</html>