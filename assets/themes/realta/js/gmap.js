$(document).ready(function () {

    var map;
    var iterator = 0;
    var markers = [];
    var markerLatLng = [
        new google.maps.LatLng(52.511467, 13.467179),
        new google.maps.LatLng(52.519061, 13.422975),
        new google.maps.LatLng(52.497622, 13.396110),
        new google.maps.LatLng(52.513683, 13.354393)
    ];
    var contentString = [
        '<div class="infobox-inner"><a href="properties-single.html"><i class="fa fa-home"></i><span>Villa</span></a></div>',
        '<div class="infobox-inner"><a href="properties-single.html"><i class="fa fa-home"></i><span>Flat</span></div>',
        '<div class="infobox-inner"><a href="properties-single.html"><i class="fa fa-home"></i><span>Commercial</span></div>',
        '<div class="infobox-inner"><a href="properties-single.html"><i class="fa fa-home"></i><span>Appartment</span></a></div>'
    ];

    function initialize() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            scrollwheel: false,
            zoom: 12,
            center: new google.maps.LatLng(52.520816, 13.410186) //Berlin
        });
        setTimeout(function () {
            drop();
        }, 1000);

    }

    // animate markers
    function drop() {
        for (var i = 0; i < markerLatLng.length; i++) {
            setTimeout(function () {
                addMarker();
            }, i * 400);
        }
    }

    function addMarker() {
        var marker = new google.maps.Marker({
            position: markerLatLng[iterator],
            map: map,
            draggable: false
            //,animation: google.maps.Animation.DROP
        });
        markers.push(marker);

        var infoBubble = new InfoBubble({
            map: map,
            content: contentString[iterator],
            position: markerLatLng[iterator],
            disableAutoPan: true,
            hideCloseButton: true,
            shadowStyle: 0,
            padding: 0,
            borderRadius: 0,
            borderWidth: 1,
            borderColor: '#00AEEF',
            backgroundColor: '#ffffff',
            backgroundClassName: 'infobox-bg',
            minHeight: 35,
            maxHeight: 230,
            minWidth: 200,
            maxWidth: 300,
            arrowSize: 5,
            arrowPosition: 50,
            arrowStyle: 0
        });

        setTimeout(function () {
            infoBubble.open(map, marker);
        }, 200);

        google.maps.event.addListener(marker, 'click', function () {
            if (!infoBubble.isOpen()) {
                infoBubble.open(map, marker);
            }
            else {
                infoBubble.close(map, marker);
            }
        });

        iterator++;
    }

    google.maps.event.addDomListener(window, 'load', initialize);

});
