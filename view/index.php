<?php
    ob_start()
?>
    <div class="container">
        <h2>Enter your location</h2>
        
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary btn-dark" type="button" onclick="btnSearch()"><img class="icon icon-white" src="/public/icons/search.svg" alt="search" height="20px"/></button>
            </div>
            <input id="location" type="text" class="form-control" placeholder="Enter your location" aria-label="" aria-describedby="basic-addon1" onkeypress="keyEnter(event)">
        </div>


        <div class="col-xs-12">
            <div id="map" style="width: 100%; height: 530px;"></div>
            <div id="lon" style="display:none;"><?php if($this->getContext()->getAttribute("location") != null): ?> <?=$this->getContext()->getAttribute("location")->lat?> <?php else:?>49.6833300<?php endif?></div> 
            <div id="lat" style="display:none;"><?php if($this->getContext()->getAttribute("location") != null): ?> <?=$this->getContext()->getAttribute("location")->lon?> <?php else:?>5.8166700<?php endif?></div>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            L.mapquest.key = 'lYrP4vF3Uk5zgTiGGuEzQGwGIVDGuy24';

            var lon = document.getElementById('lon').innerText;
            var lat = document.getElementById('lat').innerText;

            var map = L.mapquest.map('map', {
                center: [lon, lat],
                layers: L.mapquest.tileLayer('map'),
                zoom: 16
            });

            L.marker([lon, lat],{
                icon: L.mapquest.icons.marker(),
                draggable: false
            }).bindPopup('you are here!').addTo(map);

            /*
            SAMPLE USAGE OF CUSTOM ICONS
            var icon = 'https://assets.mapquestapi.com/icon/v2/flag-red-help!-lg.json';
            $.getJSON(icon, function(json){
                var LeafIcon = L.icon(json);
                L.marker([parseFloat(lon) + 0.002, parseFloat(lat) + 0.002], {icon: LeafIcon}).bindPopup("I'm a custom icon using " + icon).addTo(map);
            });
            */

            map.addControl(L.mapquest.control());

            $('.icon').svgInject();
        };

        btnSearch = function() {
            window.location.href='/home?location=' + encodeURI(document.getElementById('location').value);
        };

        keyEnter = function(event) {  
            if(event.keyCode == 13) {
                btnSearch();
            } 
        };
    </script>

<?php
    $content = ob_get_clean();
    include_once "./view/template.php";
?>