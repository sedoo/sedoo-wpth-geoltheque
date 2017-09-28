<?php
/**
*  Parametres à passer pour la création des cartes
*
*/

/*************************************************************************************************
**  Cartes
*
* homepage : map
* fiche sortie / détail : mapOl
* fiche sortie / site proximité : mapProxy
* fiche Arret / Arrets proximité : mapArrets
* fiche sortie / carte géologique : mapBrgm
**************************************************************************************************/

/*************************************************************************************************
**  Function addMap
* $map : nom de la variable map en js, de l'ID du conteneur d'affichage <div id="map"></div>, et utilisé dans nom variable calqueMarkers_[$map]
* $useLayers : fond(s) de carte utilisés [osm, brgm]
* $control : affiche le layerSwitcher
* $center : centre de la carte / toulouse = 1.438161,43.601699  (lng, lat)
* $zoom : zoom initial  / toulouse = 7
* $useQuery : true / false
* $argsQuery : arguments de la WP_Query
* $callInTab : si la carte est dans une tab, ajout d'un setTimeout, NE PAS OUBLIER de changer le nom de la fonction présente dans l'attribut onclick="nom_de_la_map()" du <li> des items du tab ; true / false
* $markers : simple / multiple
**************************************************************************************************/



function addMap($map, $useLayers, $control, $center, $zoom, $useQuery, $argsQuery, $callInTab) {   
        
    if ($useQuery == "true") {
    /***
    *  Extraction des fiches de sorties en fonction des arguments passés en WP_Query 
    *****************************************************/
    
    // The Query
    $query = new WP_Query( $argsQuery );
    }
    
    /***
    *  Ecriture de la fonction js
    *****************************************************/
    
    echo "<script>
            function ".$map."(){";
    
    if ($callInTab == "true") {
        echo "$(\"#".$map."\").empty();
                window.setTimeout(function(){";
    }
    
    /***
    *  options des cartes
    *****************************************************/
    echo '
        var options = {
                projection: new OpenLayers.Projection("EPSG:900913"),
                displayProjection: new OpenLayers.Projection("EPSG:27572"),
                allOverlays: false

       };
    ';

    /***
    *  Layers (Fonds de carte)
    *****************************************************/

    /*
    * OpenStreetMap + BRGM
    ************************/
    
    //$layers = array("var osm" => "new OpenLayers.Layer.OSM(\"Carte OpenStreetMap\");",
    $layers = array("var osm" => "new OpenLayers.Layer.OSM(\"Carte OpenStreetMap\", [\"https://a.tile.openstreetmap.org/\${z}/\${x}/\${y}.png\",
   \"https://b.tile.openstreetmap.org/\${z}/\${x}/\${y}.png\",
   \"https://c.tile.openstreetmap.org/\${z}/\${x}/\${y}.png\"] );",
                    "var brgm" => "new OpenLayers.Layer.WMS( \"Geologie BRGM\",
                               \"https://geoservices.brgm.fr/geologie\",
                                {
                                    layers: 'Geologie',
                                    srs: 'EPSG:27572',
                                    format: 'png'
                                },
                                {
                                 projection:\"EPSG:27572\",
                                 isBaseLayer:false,	
                                 reproject: false,
                                 opacity: 0.8
                                }
                            );"
                   );

    while (current($layers)) {
        echo key($layers)." = ".$layers[key($layers)]."\n";
        next($layers);
    }
    
    /***
    *  Création de la carte
    *****************************************************/
//    $map = "map_".$map."";
    //create map     
    echo "var ".$map." = new OpenLayers.Map (\"".$map."\", options);";
    
    //  Ajout des layers
    echo $map.".addLayers([".$useLayers."]);";
    
    // Ajout du controle de layers
    if ($control == "true") {
    echo $map.".addControl(new OpenLayers.Control.LayerSwitcher());  ";
    }
    
    // zoomToMaxExtent
    echo $map.".zoomToMaxExtent();";
    
    // connaître la projection utilisée par une carte
    echo "var projCarte_".$map." = ".$map.".getProjectionObject();";
    // disposer de nouvelles projections : celle de la carte (code ci-dessus) + la projection sphérique (code ci-dessous)
    echo "var projSpherique = new OpenLayers.Projection(\"EPSG:4326\");";
    
    // Centre dela carte Toulouse    
    echo "var coord = new OpenLayers.LonLat(".$center.");"; // coordonnées en longitude/latitude
    echo "coord.transform(projSpherique, projCarte_".$map.");"; // conversion  
    echo $map.".setCenter(coord,".$zoom.");";
    
    /*** 
    *     MARKERS des sorties pédagogiques
    *****************************************************/

    // création du calque des markers
    if ($map == "mapArrets") {$nameMarker="Arrêts";}else{$nameMarker="Sorties pédagogiques";}
    echo "calqueMarkers_".$map." = new OpenLayers.Layer.Markers(\"".$nameMarker."\");";
    echo $map.".addLayer(calqueMarkers_".$map.");";
    echo "var AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {'autoSize': true});";
    $i=0;
    // The Loop pour récup infos des fiches de sorties
    if ($useQuery == "true") {
        
        if ( $query->have_posts() ) {
            
            while ( $query->have_posts() ) {
                $query->the_post();
                $location = get_field('lieu-detail_sortie-edugeol');      
                // coordonnées en longitude/latitude issue de googlemap
                echo "var coordMarker_".$i." = new OpenLayers.LonLat(".$location['lng'].", ".$location['lat'].");";
                echo "var longlat, popupClass, popupContentHTML;";
                
                echo "longlat = coordMarker_".$i.".transform(projSpherique,projCarte_".$map.");";
                echo "popupClass = AutoSizeAnchored;";
                // contenu HTML
                echo "popupContentHTML = '<h1><span class=\"close\">X</span> ".get_the_title()."</h1><img src=\"".get_the_post_thumbnail_url()."\"><a href=\"".get_the_permalink()."\">Accéder à la fiche</a>';";
                
                // Création du marker par la function addMarker() , voir ci-dessous...
                echo "addMarker(longlat, popupClass, popupContentHTML);";
                
                $i++;
            }
        } 
    } else { 
        // coordonnées en longitude/latitude issue de googlemap
        echo "var coordMarker_".get_the_ID()." = new OpenLayers.LonLat(".$center.");";
        echo "var longlat, popupClass, popupContentHTML;";

        echo "longlat = coordMarker_".get_the_ID().".transform(projSpherique,projCarte_".$map.");";
        echo "popupClass = AutoSizeAnchored;";
        // contenu HTML
        echo "popupContentHTML = '<h1><span class=\"close\">X</span> ".get_the_title()."</h1><img src=\"".get_the_post_thumbnail_url()."\"><a href=\"".get_the_permalink()."\">Accéder à la fiche</a>';";

        // Création du marker par la function addMarker() , voir ci-dessous...
        echo "addMarker(longlat, popupClass, popupContentHTML);";
    }
    // fonction d'ajout des markers avec popup
    echo "
    function addMarker(ll, popupClass, popupContentHTML, closeBox, overflow) {
            var feature = new OpenLayers.Feature(calqueMarkers_".$map.", ll); 
            feature.closeBox = closeBox;
            feature.popupClass = popupClass;
            feature.data.popupContentHTML = popupContentHTML;
            feature.data.overflow = (overflow) ? \"auto\" : \"hidden\";

            var marker = feature.createMarker();

            var markerClick = function (evt) {
                if (this.popup == null) {
                    this.popup = this.createPopup(this.closeBox);
                    ".$map.".addPopup(this.popup);
                    this.popup.show();
                ";
                 // close button sur popup
                 echo "
                 $(\".close\").click(function(){
                     //console.log(this.closest(\".olPopup\"));
                    $(this).closest(\".olPopup\").css(\"display\", \"none\");
                 });
                 ";    
                echo "    
                } else {
                    this.popup.toggle();
                }
                currentPopup = this.popup;
                OpenLayers.Event.stop(evt);
            };
            marker.events.register(\"mousedown\", feature, markerClick);

            calqueMarkers_".$map.".addMarker(marker);
            
    }
    ";
       
    if ($callInTab == "true") {
        echo "}, 200); "; // end setTimetout 
    }
    /***
    *  fermeture de la fonction js
    *****************************************************/
    echo "};</script>";
    
    // Restore original Post Data
    wp_reset_postdata();
    
    echo "<script>";
    echo "
        $(document).ready(function(){
            ".$map."();
           
        });
        "; 

    echo "</script>";
    
}


/**** 
* Exemple d'usage pour la homepage
*
************/

/*
// WP_Query arguments
$argsQuery = array (
	'post_type' => array( 'fichesortie' )
);

addMap($argsQuery, "map", "osm, brgm", "true", "1.438161,43.601699", "7");
*/

?>