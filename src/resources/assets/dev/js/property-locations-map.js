import mapboxgl from 'mapbox-gl';
import 'mapbox-gl/dist/mapbox-gl.css';

mapboxgl.accessToken = window.mapbox_token;
var map = new mapboxgl.Map({
    container: 'realestate-map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [10.4515, 51.1657],
    zoom: 6
});

map.on('load', function() {
    map.addSource('realestates', {
        type: 'geojson',
        data: '/property/loactions.geojson'
    });


    map.addLayer({
        'id': 'realestates-layer',
        'type': 'circle',
        'source': 'realestates',
        'paint': {
            'circle-radius': 9,
            'circle-stroke-width': 3,
            'circle-color': '#903737',
            'circle-stroke-color': 'white'
        }
    });


    // Center the map on the coordinates of any clicked circle from the 'circle' layer.
    map.on('click', 'realestates-layer', function(e) {
        map.flyTo({
            center: e.features[0].geometry.coordinates,
            zoom: 18
        });
    });

    // Create a popup, but don't add it to the map yet.
    const popup = new mapboxgl.Popup({
        closeButton: false,
        closeOnClick: true
    });

    // Change the cursor to a pointer when the it enters a feature in the 'circle' layer.
    map.on('mouseenter', 'realestates-layer', function(e) {
        const coordinates = e.features[0].geometry.coordinates.slice();
        map.getCanvas().style.cursor = 'pointer';
        let price = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(e.features[0].properties.price)
        popup.setLngLat(coordinates).setHTML("<h6>"+e.features[0].properties.title+"</h6>" + "<br><p>" +e.features[0].properties.address + "</p><br>" + price + "<br><a class='btn btn-sm btn-primary' href='/property/"+e.features[0].properties.id+"/edit'>Ansehen</a>").addTo(map);
    });

    // Change it back to a pointer when it leaves.
    map.on('mouseleave', 'realestates-layer', function() {
        map.getCanvas().style.cursor = '';
    });
});