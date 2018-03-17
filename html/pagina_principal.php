<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/pagina_principal.css" rel="stylesheet" type="text/css"/>
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
        <link href="../css/concierto.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.slides.min.js" type="text/javascript"></script>
        <script src="../js/pagina_principal.js" type="text/javascript"></script>
    </head>
    <style>
        #divAnuncios .container {
            background-color: transparent;
        } 

        #slides img {
            box-shadow: 0 4px 4px rgba(36,37,38, 0.9) !important;
        }

        .divConciertosContainer{
            width: 90%;
            text-align: center;
            height: 30em;
            position: relative;
            display: inline-block;
            color: orange;
            overflow: hidden;
        }

        #divConciertosNovedad {

            height: 100%;
            color: white;
        }

        .conciertoNovedadContainer {

            position: relative;
            display: inline-block;
            width: 100%;
            height: 30em;
            overflow: hidden;

            /*background-color: red;*/
        }

        .conciertoBody{

            position: relative !important;
            display: inline-block !important;
            width: 100%;
            padding-top: 2%;
            height: 78%;
            overflow: hidden;
            box-shadow:0 0 8px 0 black;
        }

        .conciertoFooter{

            position: relative;
            width: 100%;
            background-color: rgba(0,0,0,0.15);
            height: 9%;
            border-radius: 0.5em;
            box-shadow:0 0 8px 0 rgba(0,0,0,0.5);
        }

        .conciertoImageArt {

            display: inline-block;
            position: relative;
            width: 100%;
            top: -180%;
            margin: auto;
            /*            height: 100% !important;*/
        }

        .slickConciertos {

            position: relative;
            display: inline-block;
            width: 100%;
            height: 100%;
        }

        .slick-dots {

            bottom: 1px !important;
        }

        .slick-dots li button:before{

            color: white;
        }

        .slick-dots li.slick-active button:before{
            color: orange;
        }

        .musicoGeneroSlider{

            position: relative;
            width: 100%;
            height: auto;
            padding: 10px;
            margin-top: 1em;
            background-color: rgba(255,255,55,0.02);
            display: inline-block;
        }

        .musicoGeneroSliderContent{

            position: relative;
            display: inline-block;
            width: auto;
            height: auto;
            padding: 0.5em;
            margin-top: 0.5em;
        }

        .musicoGeneroWrapperContainer {

            position: relative;
            display: inline-block;
            width: 20em;
            height: 14em;
            border-radius: 2px;
            box-shadow: 0 0px 10px rgba(36,37,38,0.2);
            padding-top: 0.2em;
            padding-bottom: 0.2em;
        }

        .musicoGeneroWrapperImage {

            position: relative;
            display: inline-block;
            width: 100%;
            height: 81%;
        }

        .musicoGeneroWrapperInfo {

            position: relative;
            display: inline-block;
            width: 100%;
            height: 19%;
            margin-top: -1%;
            text-align: center;
            background-color: rgba(0,0,0,0.2);
        }

        .musicoGeneroTitulo{

            margin-left: 1em;
        }
    </style>
    <body>
        <div class="_childContainer">
            <div class="divConciertosContainer centeredElementHorizontal">
                <div class="slickConciertos" id="divConciertosNovedad">
                </div> 
            </div>
            <div id="divGeneros">
            </div>
            <div id="divMusicos">

            </div>
            <!--            <div class="right">
                                            <div id="divBuscador">
                                                <h1 class="tituloH1 tituloH1-Grey">Buscar</h1>
                                                <div class="Input" style="width:100%; height: 40%;">
                                                    <input type="text" id="input" class="Input-text" placeholder="Buscar conciertos...">
                                                </div>
                                            </div>
                            <div id="divAnuncios">
                               
                            </div>
                        </div>-->
        </div>
    </body>
</html>
