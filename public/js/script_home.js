window.onload = function() {
    var lon = document.getElementById('lon').innerText;
    var lat = document.getElementById('lat').innerText;

    var map = new L.Map('map').setView([lat,lon], 16);
    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 16
    }).addTo(map);

    map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

    var shelterMarkers = L.featureGroup();
    shelterMarkers.addTo(map);

    var restaurantIcon = L.icon({
        iconUrl: '/public/img/marker.png',
        iconSize: [24, 24], // size of the icon
    });
    
    var locationIcon = L.icon({
        iconUrl: '/public/img/location.png',
        iconSize: [24, 24], // size of the icon
    });

    // CREATE LOCATION ICON
    var marker = new L.Marker([lat,lon], {icon: locationIcon}).bindPopup("You are Here !");
    marker.addTo(shelterMarkers);

    // CREATE RESTAURANT ICONS
    var restaurants = $('.caption');
    for(var i = 0; i < restaurants.length; i++)
    {   
        var lon = restaurants[i].getElementsByClassName('lon')[0].innerHTML;
        var lat = restaurants[i].getElementsByClassName('lat')[0].innerHTML;
        var title = restaurants[i].getElementsByClassName('name')[0].innerHTML;
        
        var marker = new L.Marker([lat, lon], {icon: restaurantIcon}).bindPopup(title);
        marker.addTo(shelterMarkers);
    }

    shelterMarkers.addTo(map);
    map.fitBounds(shelterMarkers.getBounds());
};
        
var btnSearch = function() {
    window.location.href='/home?location=' + encodeURI(document.getElementById('location').value);
};

var keyEnter = function(event) {  
    if(event.keyCode == 13) {
        btnSearch();
    } 
};