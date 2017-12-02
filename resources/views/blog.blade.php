<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#4caf50">
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon2.png') }}" />
        <title>Oger Vihikan</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Raleway:100, 300,400,500,600,700,800,900" rel="stylesheet">

        <link type="text/css" href="{{ asset('css/style-blog.css') }}" rel="stylesheet">
        

    </head>
    <body>
        <nav id="header" class="navbar ">
            <div id="header-container" class="container navbar-container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="web-title">
                        <a id="text-O"class="logo-text">O</a>ger <a id="text-V"class="logo-text">V</a>ihikan
                    </div>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid ">
            <div class="row row-offcanvas row-offcanvas-right">
                <div class="col-xs-12 col-sm-10">
                    @yield('content')
                    
                </div><!--/.col-xs-12.col-sm-9-->

                <div class="col-xs-6 col-sm-2 ads-container" id="sidebar">
                    <img id="ads" src="{{ asset('img/ml2.jpg') }}">
                </div><!--/.sidebar-offcanvas-->
            </div><!--/row-->

            <hr>
            <footer>
                <p>© Oger Vihikan 2017</p>
            </footer>
        </div>
        <script id="dsq-count-scr" src="//ogervihikan.disqus.com/count.js" async></script>
    </body>

    <script>
    $(document).ready(function(){

    })
        
    </script>
</html>
