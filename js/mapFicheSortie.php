<!--   CARTE BRGM  -->   
<?php
// Chargement script externe + CSS
//include("commons-map.php");
?>
                                                                      
<script>
var mapOl, osm, brgm;

function init(){
    var options = {
            projection: new OpenLayers.Projection("EPSG:900913"),
            displayProjection: new OpenLayers.Projection("EPSG:27572"),
            allOverlays: false

   };

    // Création des cartes
    // mapOl = carte utilisée dans les détails de la sortie (colonne de droite)
    mapOl = new OpenLayers.Map ("mapOl", options);

    /*************************************************************************************************
    **  Layers (Fonds de carte)
    **************************************************************************************************/
    
    /*
    * OpenStreetMap 
    **************************/
    osm = new OpenLayers.Layer.OSM("Carte OpenStreetMap");

    /*
    *  BRGM
    **************************/

    brgm = new OpenLayers.Layer.WMS( "Geologie BRGM",
           "http://geoservices.brgm.fr/geologie",
            {
                layers: 'Geologie',
                srs: 'EPSG:27572',
                format: 'png'
            },
            {
             projection:"EPSG:27572",
             isBaseLayer:false,	
             reproject: false,
             opacity: 0.8
            }
        );

    /*
    **  Ajout des layers
    ***************************************/
    mapOl.addLayer(osm);
//    mapOl.addLayers([osm, brgm]);
    
    /*************************************************************************************************
    **  Controls
    **************************************************************************************************/
//    mapOl.addControl(new OpenLayers.Control.LayerSwitcher());   
    
    mapOl.zoomToMaxExtent();
    
    // connaître la projection utilisée par une carte
    var projCarte = mapOl.getProjectionObject();

    console.log("projection utilisee : "+projCarte);  // retourne EPSG:900913
    console.log("getUnits :"+projCarte.getUnits() );

    // disposer de nouvelles projections : celle de la carte (code ci-dessus), la projection sphérique
    var projSpherique = new OpenLayers.Projection("EPSG:4326");    
    console.log("projection spherique : "+projSpherique);   
    console.log("getUnits :"+projSpherique.getUnits() );
    
    /*** 
    *     MARKERS 
    ***************************/

    // création du calque des markers
    calqueMarkers = new OpenLayers.Layer.Markers("Sorties pédagogiques");
    mapOl.addLayer(calqueMarkers);    
    
   var AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {'autoSize': true});
  
    // coordonnées en longitude/latitude issue de googlemap
    var coordMarker<?php the_ID();?> = new OpenLayers.LonLat(<?php echo $location['lng'];?>, <?php echo $location['lat'];?>);

    var longlat, popupClass, popupContentHTML;

    longlat = coordMarker<?php the_ID();?>.transform(projSpherique,projCarte);
    console.log("longLat :"+longlat);
    popupClass = AutoSizeAnchored;
    // contenu HTML
    popupContentHTML = '<h1><?php the_title();?></h1><img src="<?php the_post_thumbnail_url(); ?>"><a href="<?php the_permalink(); ?>">Accéder à la fiche</a>';

    // Création du marker par la function addMarker() , voir ci-dessous...
    addMarker(longlat, popupClass, popupContentHTML);

    mapOl.setCenter(longlat,12);    
    
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
                    mapOl.addPopup(this.popup);
                    this.popup.show();
                } else {
                    this.popup.toggle();
                }
                currentPopup = this.popup;
                OpenLayers.Event.stop(evt);
            };
            marker.events.register("mousedown", feature, markerClick);

            calqueMarkers.addMarker(marker);
    }


};

</script>
                            
