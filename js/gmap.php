
<div id="map" style="width: 100%; height: 250px;"></div>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDbsVyq2L-4EjKLryvA3cah_AsPp3F5PNk' type='text/javascript'></script>

<script type="text/javascript">
  //<![CDATA[
    function load() {
    var lat = <?php echo $location['lat']; ?>;
    var lng = <?php echo $location['lng']; ?>;
// coordinates to latLng
    var latlng = new google.maps.LatLng(lat, lng);
// map Options
    var myOptions = {
    zoom: 9,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
   };
//draw a map
    var map = new google.maps.Map(document.getElementById("map"), myOptions);
    var marker = new google.maps.Marker({
    position: map.getCenter(),
    map: map
   });
}
// call the function
   load();
//]]>
</script>