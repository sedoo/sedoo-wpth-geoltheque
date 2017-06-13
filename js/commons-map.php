<script src="<?php echo get_bloginfo('template_directory') ?>/js/OpenLayers.js"></script>
<script src="<?php echo get_bloginfo('template_directory') ?>/js/proj4js-compressed.js"></script>
<script src="<?php echo get_bloginfo('template_directory') ?>/js/EPSG27572.js"></script>     
<style type="text/css">
    #mapHome,
    #mapOl,
    #mapBrgm, 
    #mapProxy,
    #mapArrets
    {
        width: 100%;        
    }
    #mapHome,
    #mapBrgm,
    #mapProxy,
    #mapArrets {
        height: 500px;
    }
    #mapOl {
        height: 200px;
    }
    
    .olControlOverviewMapElement {
        width: 100px;
        height: 150px;
    }

    [id^=OpenLayers_Control_Attribution].olControlAttribution {
        bottom: 0;
        right: 0;
        padding: 2px 5px;
        background: rgb(221, 153, 70);
        color: #FFF;
        border: 1px solid #FFF;
    }

    div[id^=OpenLayers_Control_Zoom].olControlZoom a {
        background: #DD9946;
    }

    div[id^=OpenLayers_Control_Zoom].olControlZoom a:hover {
        background: #313332;
    }

    #OpenLayers_Control_MaximizeDiv {
        width: 60px;
        height: 40px;
        background-position: center center;
        background-image: url("<?php echo get_bloginfo('template_directory') ?>/svg/ic_terrain_black_24px.svg");
        background-repeat: no-repeat;
        background-size: 80%;
        content: "Fonds de carte";
    }

    #OpenLayers_Control_MaximizeDiv > img {
        display: none;
    }

    .olControlLayerSwitcher [id^=OpenLayers_Control_LayerSwitcher].layersDiv,
    #OpenLayers_Control_MaximizeDiv {
        background-color: rgba(221, 153, 70, 1);
        border: 1px solid #FFF;
        border-radius: 5px 0 0 5px;
        box-shadow: 0 0 2px 3px rgba(255, 255, 255, .6);
    }
    .olPopup {
            overflow-y: scroll;
            width: 200px;
            min-height: 200px;
            background: #CECAC2;
            
        }
        .olPopupContent {
            padding: 0;
            overflow: scroll!important;
        }
        .olPopup h1 {
            margin: 0;
            padding: 10px;
            background:#DD9946;
            color: white;
            font-size: 15px;

        }
        .olPopup img {
            display: block;
            max-height: 150px;
        }
        
        .olPopup a {
            display: block;
            width: 80%;
            margin:10px auto;
            padding: 5px 10px;
            background: #dd9946;
            border-radius: 5px;
            font-size: 0.9em;
            color: #FFF;
            text-align: center;
        }
</style>