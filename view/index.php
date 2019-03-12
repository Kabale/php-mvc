<?php
    ob_start()
?>
    <div class="container">
        <h1>Index</h1>
        <div class="col-xs-12">
            <div id="map" style="width: 100%; height: 530px;"></div>
        </div>
    </div>
    
        <script>
        window.onload = function() {
            L.mapquest.key = 'lYrP4vF3Uk5zgTiGGuEzQGwGIVDGuy24';

            var map = L.mapquest.map('map', {
                center: [37.7749, -122.4194],
                layers: L.mapquest.tileLayer('map'),
                zoom: 15
            });

            map.addControl(L.mapquest.control());
        }
        </script>
<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>