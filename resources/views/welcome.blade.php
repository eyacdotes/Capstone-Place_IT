<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Place.It</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway';
                font-weight: 100;
                height: 100vh;
                margin: 0;
                padding: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-left {
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                top: 18px;
                display: flex;
                gap: 15px;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                display: flex;
                gap: 15px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 15px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* Responsive styles */
            @media (max-width: 768px) {
                .top-left,
                .top-right {
                    flex-direction: column;
                    align-items: center;
                    position: static;
                    margin-top: 10px;
                }

                .top-left a,
                .top-right a {
                    padding: 10px;
                    font-size: 14px;
                }

                .top-right {
                    margin-top: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login') && Auth::check())
                <div class="top-right links">
                    <a href="{{ url('/home') }}">Dashboard</a>
                </div>
            @elseif (Route::has('login') && !Auth::check())
                <!-- Top center links -->
                <div class="top-left links">
                    <a href="{{ url('/') }}">place.it</a>
                    <a href="{{ url('/about') }}">About Us</a>
                    <a href="{{ url('/services') }}">Services</a>
                    <a href="{{ url('/contact') }}">Contact</a>
                </div>
                <!-- Top right links -->
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Get Started</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://codecasts.com.br">CODECASTS [pt-BR]</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/codecasts/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
