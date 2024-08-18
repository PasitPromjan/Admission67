<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    <style>
                * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        .js-preloader {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.99);
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            opacity: 1;
            visibility: visible;
            z-index: 9999;
            -webkit-transition: opacity 0.25s ease;
            transition: opacity 0.25s ease;
        }

        .js-preloader.loaded {
            opacity: 0;
            visibility: hidden; 
            pointer-events: none;
        }

        .loader {
            position: relative;
            width: 100px;
            height: 100px;
        }
        
        .loader:before , .loader:after{
            content: '';
            border-radius: 50%;
            position: absolute;
            inset: 0;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, 0.3) inset;
        }
        .loader:after {
            box-shadow: 0 2px 0 #FF3D00 inset;
            animation: rotate 2s linear infinite;
        }
        
        @keyframes rotate {
            0% {  transform: rotate(0)}
            100% { transform: rotate(360deg)}
        }        
    </style>


</head>
<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <span class="loader"></span>
    </div>
    <!-- ***** Preloader End ***** -->

    <h1>Hello World</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptate iusto cum eius illum quidem laborum in nulla soluta sunt nemo asperiores saepe autem blanditiis molestias nihil, ullam repellendus quasi! Dolores!</p>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="ts.js"></script>
</body>

<script>
    (function ($) {

        $(window).on("load", function() {
            $("#js-preloader").addClass("loaded");
        });

    })(window.jQuery);
</script>
</html>