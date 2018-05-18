<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
    </head>
    <style>
        .conciertoContainer{

            display: inline-block;
            padding: 1em;
            /*background-color: orange;*/   
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

        #divMusicos {

            display: inline-block !important;
            overflow: hidden;
        }
    </style>
    <body>
        <div class="_childContainer divPadding10">
            <!--<h1 class="tituloH1 tituloH1-Grey">Página FAN</h1>-->
            <div id="divConciertosFan">

            </div>
            <div id="divMusicosFan">

            </div>
        </div>
        <script src="../js/pagina_fan.js" type="text/javascript"></script>
    </body>
</html>
