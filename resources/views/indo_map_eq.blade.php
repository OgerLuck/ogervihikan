<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Peta Gempa Indonesia</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

        <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.min.css">

        <style>
          #map {
            height: 100vh;
            width: 100%;
          }
          html, body {
            height: 100%;
            margin: 0;
            padding: 0;
          }
          .container{
            height: 100vh;
            width: 100%;
            margin: 0;
            padding: 0;
          }
          .row{
            margin: 0;
            padding: 0;
          }

          #map-container{
            margin: 0;
            padding: 0;
          }

          .well, .well-sm{
            margin: 0;
            padding: 0;
          }

          #info{
            padding-left: 15px;
            padding-right: 15px;
            margin-bottom: 15px;
          }

          #judul{
            text-align: center;
          }

          #sandbox-container{
            margin-bottom: 15px;
          }
        </style>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div id="map-container" class="col-md-10">
                    <div id="map"></div>
                </div>
                <div class="col-md-2">
                    <div id="info-container">
                        <h1 id="judul">Data Gempa</h1>
                        <div id="sandbox-container">
                            <div class="input-group date">
                              <input type="text" class="form-control" value= ""><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                        <div id="info" class="well well-sm">
                            <h5>Waktu : </h5>
                            <h5>Mag : </h5>
                            <h5>Kedalaman : </h5>
                        </div>

                        <div id="info" class="well well-sm">
                            <h5>Waktu : </h5>
                            <h5>Mag : </h5>
                            <h5>Kedalaman : </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script>
    $(document).ready(function(){
        $('#sandbox-container .input-group.date').datepicker({
            format: "dd/mm/yyyy",
            keyboardNavigation: false,
            todayHighlight: true
        });
        $('#sandbox-container .input-group.date input').datepicker('update', new Date());

        $('#sandbox-container .input-group.date').datepicker().on("changeDate", function(e) {
            console.log($('#sandbox-container .input-group.date input').val());
        });
    })

        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -1.5801344, lng: 122.3537796},
                zoom: 5
                
            });

            var script = document.createElement('script');

            script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
            document.getElementsByTagName('head')[0].appendChild(script);

            map.data.setStyle(function(feature) {
                var magnitude = feature.getProperty('mag');
                return {
                    icon: getCircle(magnitude)
                };
            });
        } 

        function getCircle(magnitude) {
            return {
                path: google.maps.SymbolPath.CIRCLE,
                fillColor: 'red',
                fillOpacity: .2,
                scale: Math.pow(2, magnitude) / 2,
                strokeColor: 'white',
                strokeWeight: .5
            };
        }

        function eqfeed_callback(results) {
            map.data.addGeoJson(results);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBr30aq1A__lDKwfm9xtQ1-87uqthSlMyA&callback=initMap"
    async defer></script>
</html>
