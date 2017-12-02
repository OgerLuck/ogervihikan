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

        <link type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet">

        <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div class="container flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <a id="text-O"class="logo-text">O</a>ger <a id="text-V"class="logo-text">V</a>ihikan
                </div>

                {{-- <div class="links">
                    <div class="dropdown subject">
                        <button class="menu-btn subject-btn">Blog</button> --}}
{{--                         <div class="dropdown-content">
                            <a id="subjects" href="{{ URL::route('ViewBlog') }}">Artificial Neural Network</a>
                        </div> --}}
                    {{-- </div>
                    <div class="dropdown apps">
                        <button class="menu-btn apps-btn">Apps</button>
                        <div class="dropdown-content">
                            <a id="indo_map_eq" href="{{ URL::route('ViewPetaGempaIndonesia') }}">Indonesian Earthquake Map</a> --}}
                            {{-- <a id="aksara_bali_ai" href="{{ URL::route('ViewAksaraBaliNeuralNetwork') }}">Aksara Bali A.I.</a> --}}
                        {{-- </div>
                    </div>
                    <button class="menu-btn about-btn">About</button>
                </div>
                <div class="about">
                    <div class="about-text">
                        <img class="img-circle pic" src="img/foto.png">
                        <p class="bio">I am a student from Information Technology Department, Udyana Univeristy. This website is a place for me to share my experience about interesting IT subjects that I learned and several IT projects which I made just for fun. I hope you guys can learn something new here.</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </body>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".about-btn").click(function(){
                if ($(".about").css('max-height')=='0px'){
                    $(".about").css('max-height', '350px');
                } else{
                    $(".about").css('max-height', '0px');
                }
            });

            $(".subject-btn").click(function(){
                window.location.href = "{{ URL::route('ViewBlogList') }}";
            })
        });


    </script>
</html>
