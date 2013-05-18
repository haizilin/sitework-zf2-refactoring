var SW = SW || {
    init : function () {


    },
    googleMap : function (mapElementId, lon, lat, address) {
        if (GBrowserIsCompatible()) {
            $('body').unload(function () {
                GUnload();
            });
            var map = new GMap2(document.getElementById("map"));
            var point = new GLatLng(lat, lon);
            map.setCenter(point, 13);
            map.setUIToDefault();
            var marker = new GMarker(point);
            map.addOverlay(marker, address);
            GEvent.addListener(marker, "click", function () {
                marker.openInfoWindowHtml(address);
            });
            marker.openInfoWindowHtml(address);
        }
    },
    googleMapByAddress : function (mapElementId, name, address) {
        if (GBrowserIsCompatible()) {
            $('body').unload(function () {
                GUnload();
            });
            geocoder = new GClientGeocoder();
            geocoder.getLatLng(
                address,
                function(point) {
                    var map = new GMap2(document.getElementById("map"));
                    map.setCenter(point, 13);
                    map.setUIToDefault();
                    var marker = new GMarker(point);
                    map.addOverlay(marker, address);
                    GEvent.addListener(marker, "click", function () {
                        marker.openInfoWindowHtml(name + '<br>' + address);
                    });
                    marker.openInfoWindowHtml(name + '<br>' + address);
                }
            );


        }
    },
};
