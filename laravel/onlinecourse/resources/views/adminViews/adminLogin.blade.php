<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NTU | Login</title>
        <!-- css -->
        <link rel = "stylesheet" href = "{{(asset('assets/css/loginAdmin.css')}}" />
        <link rel = "stylesheet" href = "{{(asset('assets/css/checkError.css')}}"/>
        <link href="{{(asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel = icon href = "{{asset('assets/img/logo/ntu-logo.png')}}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="logo"></div>
            <div class="login-page">
                <div class = 'form'>
                <h1>Login</h1>
                <form class = "login-form" action = "adminLogin.php" method = "POST">
                    <input type="text" name="username" placeholder="Username" required />
                    <input type="password" name="password" placeholder="Password" required />
                    <input id = "button" type="submit" name="submit" value = "Login">
                </form>
                </div>
            </div>
        </div>
    </body>
</html>
