<?php
// WP_Query arguments
$args = array (
	'post_type' => array( 'fichesortie' )
);
// The Query
$query = new WP_Query( $args );

// Chargement script externe + CSS
include("commons-map.php");
?>



<script>
var map, osm, brgm;
function init(){

    <?php include("parameters-map.php");?>

    // Création de la carte 
    map = new OpenLayers.Map ("map", options);

    /*************************************************************************************************
    **  Layers (Fonds de carte)
    **************************************************************************************************/
    
    /*
    * OpenStreetMap 
    **************************/
//    osm = new OpenLayers.Layer.OSM("Carte OpenStreetMap");

    /*
    *  BRGM
    **************************/

//    brgm = new OpenLayers.Layer.WMS( "Geologie BRGM",
//           "http://geoservices.brgm.fr/geologie",
//            {
//                layers: 'Geologie',
//                srs: 'EPSG:27572',
//                format: 'png'
//            },
//            {
//             projection:"EPSG:27572",
//             isBaseLayer:false,	
//             reproject: false,
//             opacity: 0.8
//            }
//        );
    
    /*
    **  Test KML MARKERS
    **************************/
    console.log('map.displayProjection : '+map.displayProjection);
    
    /*
    **  Ajout des layers
    ***************************************/
    map.addLayers([osm, brgm]);
    
    
    /*************************************************************************************************
    **  Controls
    **************************************************************************************************/
    map.addControl(new OpenLayers.Control.LayerSwitcher());   
    map.zoomToMaxExtent();


    // connaître la projection utilisée par une carte
    var projCarte = map.getProjectionObject();    
    console.log("projection utilisee : "+projCarte);  // retourne EPSG:900913
    console.log("getUnits :"+projCarte.getUnits() );

    // disposer de nouvelles projections : celle de la carte (code ci-dessus), la projection sphérique
    var projSpherique = new OpenLayers.Projection("EPSG:4326");    
    console.log("projection spherique : "+projSpherique);   
    console.log("getUnits :"+projSpherique.getUnits() );



    // Centre sur Toulouse    
    var coord = new OpenLayers.LonLat(1.438161,43.601699); // coordonnées en longitude/latitude
    coord.transform(projSpherique, projCarte); // conversion   
    console.log("Toulouse : "+coord);    
    map.setCenter(coord,7);    
    
    /*** 
    *     MARKERS 
    ***************************/

    // création du calque des markers
    calqueMarkers = new OpenLayers.Layer.Markers("Sorties pédagogiques");
    map.addLayer(calqueMarkers);
    
   var AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {'autoSize': true});

    <?php
    // The Loop pour récup infos des fiches de sorties
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $location = get_field('lieu-detail_sortie-edugeol');
            ?>
            
            
            // coordonnées en longitude/latitude issue de googlemap
            var coordMarker<?php the_ID();?> = new OpenLayers.LonLat(<?php echo $location['lng'];?>, <?php echo $location['lat'];?>);
            console.log()
            var longlat, popupClass, popupContentHTML;

            longlat = coordMarker<?php the_ID();?>.transform(projSpherique,projCarte);
            popupClass = AutoSizeAnchored;
            // contenu HTML
            popupContentHTML = '<h1><?php the_title();?></h1><img src="<?php the_post_thumbnail_url(); ?>"><a href="<?php the_permalink(); ?>">Accéder à la fiche</a>';
    
            // Création du marker par la function addMarker() , voir ci-dessous...
            addMarker(longlat, popupClass, popupContentHTML);

            
    
            <?php
        }
    }
    ?>

    
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
                    map.addPopup(this.popup);
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
<?php
// Restore original Post Data
wp_reset_postdata();

?>