// Handles Google Maps rendering with multiple markers (ACF style maps)
class GMap {
    constructor() {
        // Initialize a map for each ".acf-map" element on the page
        document.querySelectorAll(".acf-map").forEach((mapElement) => {
            this.initMap(mapElement);
        });
    }

    // Create a new Google Map instance for a given DOM element
    initMap(mapElement) {
        const markerElements = mapElement.querySelectorAll(".marker");

        // Default map configuration
        const mapOptions = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        // Create map instance
        const map = new google.maps.Map(mapElement, mapOptions);

        // Store markers on the map instance
        map.markers = [];

        // Add all markers found inside this map container
        markerElements.forEach((markerEl) => {
            this.addMarker(markerEl, map);
        });

        // Adjust map viewport based on markers
        this.centerMap(map);
    }

    // Add a single marker to the map
    addMarker(markerElement, map) {
        // Create LatLng object from data attributes
        const position = new google.maps.LatLng(
            markerElement.getAttribute("data-lat"),
            markerElement.getAttribute("data-lng")
        );

        // Create and display marker
        const marker = new google.maps.Marker({
            position,
            map,
        });

        // Save marker reference
        map.markers.push(marker);

        // If marker has inner HTML, show it inside an InfoWindow
        if (markerElement.innerHTML.trim()) {
            const infoWindow = new google.maps.InfoWindow({
                content: markerElement.innerHTML,
            });

            // Open InfoWindow when marker is clicked
            marker.addListener("click", () => {
                infoWindow.open(map, marker);
            });
        }
    }

    // Center the map based on all existing markers
    centerMap(map) {
        const bounds = new google.maps.LatLngBounds();

        // Extend bounds for each marker position
        map.markers.forEach((marker) => {
            bounds.extend(marker.getPosition());
        });

        // If only one marker exists, zoom in
        if (map.markers.length === 1) {
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
        } else {
            // Fit map to show all markers
            map.fitBounds(bounds);
        }
    }
}

export default GMap;
