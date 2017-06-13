<!--   CARTE BRGM  -->    
<?php
// Chargement script externe + CSS
include("commons-map.php");
?>


<script>
var mapBrgm, osm, brgm;

function initBrgm(){
    $("#mapBrgm").empty();
    window.setTimeout(function(){
    
    <?php include("parameters-map.php");?>

    // Création des cartes
    // mapOl = carte utilisée dans les détails de la sortie (colonne de droite)
    // mapBrgm = carte utilisée dans la description de la sortie (colonne gauche,onglet carte géologique)
//    mapOl = new OpenLayers.Map ("mapOl", options);
    mapBrgm = new OpenLayers.Map ("mapBrgm", options);

    
    /*
    **  Ajout des layers
    ***************************************/
    mapBrgm.addLayers([osm, brgm]);
    
    /*************************************************************************************************
    **  Controls
    **************************************************************************************************/
    mapBrgm.addControl(new OpenLayers.Control.LayerSwitcher());   
    
    mapBrgm.zoomToMaxExtent();
    
    // connaître la projection utilisée par une carte
    var projCarteBrgm = mapBrgm.getProjectionObject();    

    console.log("projection utilisee : "+projCarteBrgm);  // retourne EPSG:900913
    console.log("getUnits :"+projCarteBrgm.getUnits() );

    // disposer de nouvelles projections : celle de la carte (code ci-dessus), la projection sphérique
    var projSpherique = new OpenLayers.Projection("EPSG:4326");    
    console.log("projection spherique : "+projSpherique);   
    console.log("getUnits :"+projSpherique.getUnits() );
    
    /*** 
    *     MARKERS 
    ***************************/

    // création du calque des markers
    calqueMarkersBrgm = new OpenLayers.Layer.Markers("Sorties pédagogiques");
    mapBrgm.addLayer(calqueMarkersBrgm);
    
    
   var AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {'autoSize': true});
  
    // coordonnées en longitude/latitude issue de googlemap
    var coordMarker<?php the_ID();?> = new OpenLayers.LonLat(<?php echo $location['lng'];?>, <?php echo $location['lat'];?>);

    var longlat, popupClass, popupContentHTML;

    longlat = coordMarker<?php the_ID();?>.transform(projSpherique,projCarteBrgm);
    console.log("longLat :"+longlat);
    popupClass = AutoSizeAnchored;
    // contenu HTML
    popupContentHTML = '<h1><?php the_title();?></h1><img src="<?php the_post_thumbnail_url(); ?>">';

    // Création du marker par la function addMarker() , voir ci-dessous...
    addMarker(longlat, popupClass, popupContentHTML);

    mapBrgm.setCenter(longlat,10);

    }, 200); // end setTimetout 

    function addMarker(ll, popupClass, popupContentHTML, closeBox, overflow) {
                var feature = new OpenLayers.Feature(calqueMarkers, ll); 
                feature.closeBox = closeBox;
                feature.popupClass = popupClass;
                feature.data.popupContentHTML = popupContentHTML;
                feature.data.overflow = (overflow) ? "auto" : "hidden";

                var marker = feature.createMarker();

                var markerClick = function (evt) {
                    if (this.popup == null) {
                        this.popup = this.createPopup(this.closeBox);
                        mapBrgm.addPopup(this.popup);
                        this.popup.show();
                    } else {
                        this.popup.toggle();
                    }
                    currentPopup = this.popup;
                    OpenLayers.Event.stop(evt);
                };
                marker.events.register("mousedown", feature, markerClick);

                calqueMarkersBrgm.addMarker(marker);
    }

};

</script>
                            
