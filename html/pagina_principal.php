<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/pagina_principal.css" rel="stylesheet" type="text/css"/>
        <link href="../css/musico.css" rel="stylesheet" type="text/css"/>
        <link href="../css/concierto.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.slides.min.js" type="text/javascript"></script>
    </head>
    <style>
        #divAnuncios .container {
            background-color: transparent;
        } 
        
        #slides img {
            box-shadow: 0 4px 4px rgba(36,37,38, 0.9) !important;
        }
    </style>
    <body>
        <div class="_childContainer">
            <div class="left">
                <!--<h1 class="tituloH1 tituloH1-Grey">Próximos Conciertos</h1>-->
              <!--                <div id="divProximosConciertos">
                                </div>-->
                <h1 class="tituloH1 tituloH1-Grey">Músicos</h1>
                <div id="divMusicos">

                </div>
            </div>
            <div class="right">
<!--                <div id="divBuscador">
                    <h1 class="tituloH1 tituloH1-Grey">Buscar</h1>
                    <div class="Input" style="width:100%; height: 40%;">
                        <input type="text" id="input" class="Input-text" placeholder="Buscar conciertos...">
                    </div>
                </div>-->
                <div id="divAnuncios">
<!--                    <h1 class="tituloH1 tituloH1-Grey">Anuncios</h1>
                    <div class="container">
                        <div id="slides">
                            <img src="img/example-slide-1.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                            <img src="img/example-slide-2.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
                            <img src="img/example-slide-3.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
                            <img src="img/example-slide-4.jpg" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <script>
            obtenerMusicos();

//            $(function () {
//                $('#slides').slidesjs({
//                    width: 200,
//                    height: 120,
//                    navigation: false,
//                    pagination: {
//                        active: false,
//                        // [boolean] Create pagination items.
//                        // You cannot use your own pagination. Sorry.
//                        effect: "fade"
//                                // [string] Can be either "slide" or "fade".
//                    },
//                    play: {
//                        active: false,
//                        // [boolean] Generate the play and stop buttons.
//                        // You cannot use your own buttons. Sorry.
//                        effect: "fade",
//                        // [string] Can be either "slide" or "fade".
//                        interval: 2000,
//                        // [number] Time spent on each slide in milliseconds.
//                        auto: true,
//                        // [boolean] Start playing the slideshow on load.
//                        swap: true,
//                        // [boolean] show/hide stop and play buttons
//                        pauseOnHover: false,
//                        // [boolean] pause a playing slideshow on hover
//                        restartDelay: 2500
//                                // [number] restart delay on inactive slideshow
//                    }
//                });
//            });
        </script>
    </body>
</html>
