<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Personal Apps</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    </head>

    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">ورود</a>
                    <a href="{{ url('/register') }}">ثبت نام</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    اپلیکیشن شخصی رابین
                </div>

                <div class="links">
                    <a href="#">اخبار</a>
                    <a href="#">درباه ما</a>
                    <a href="#">ارتباط با ما</a>
                </div>
            </div>
        </div>
    </body>
</html>
