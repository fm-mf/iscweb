export default function initGMapsPreview() {
    if (typeof google === 'undefined' || google == null) {
        return;
    }

    const myLatlng = new google.maps.LatLng(50.10064, 14.386913);
    const mapOptions = {
        center: new google.maps.LatLng(50.10064, 14.426913),
        zoom: 13,
        scrollwheel: false,
        disableDefaultUI: true,
        zoomControl: true
    };
    const map = new google.maps.Map(
        document.getElementById('map-preview'),
        mapOptions
    );
    const image = '/img/web/marker.png';
    const marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: image,
        title: 'ESN Point'
    });
}
