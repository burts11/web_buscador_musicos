<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
        <link href="../css/paginado.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .conciertoContainer{

            display: inline-block;
            padding: 1em;
            /*background-color: orange;*/   
        }

        .conciertoAlbumArtImg{

            position: relative;
            width: 100%;
            height: 100%;
        }

        .musicoInfoV3{
            margin-top: 0.5em;
        }

        #divConciertosFan .conciertoAlbumArtContainer{

            position: relative;
            height: 80%;
        }

        #divConciertosFan .conciertoBody {
            height: 75%;
        }

        #divConciertosFan .conciertoFooter {

            padding-top: 0.2em;
            height: 35%;
        }

        #divMusicosFan .musicoBody {

            height: 75%;
        }

        #divMusicosFan .musicoFooter {

            height: 35%;
        }

        #divMusicosFan .musicoVoteContainer{

            position: relative;
            /*background-color: orange;*/
            width: 1.2em;
            height: 1.2em;
            float: right;
            right: 1.2em;
        }

        .musicoVoteBtn, .conciertoVoteBtn{

            position: relative;
            /*background-color: red;*/
            width:100%;
            height: 100%;
        }

        #divConciertosFan {

            width: 100%;
            display: inline-block !important;
            overflow: hidden;
        }
        #btnSiguienteConcierto {
            display: inline-block;
        }
        #btnAnteriorConcierto {
            margin-left: 0.5em;
            display: inline-block;
        }
        #divMusicos {

            display: inline-block !important;
            overflow: hidden;
        }
        #botones {
            display: inline-block;
            margin-left: 0.6em;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <!--<h1 class="tituloH1 tituloH1-Grey">Página FAN</h1>-->
            <div id="divConciertosFan">

            </div>
            <div id="botones"></div>
            <div id="divMusicosFan">

            </div>
        </div>
        <script src="../js/pagina_fan.js" type="text/javascript"></script>
    </body>
</html>
