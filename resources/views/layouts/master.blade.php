<!doctype html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'mchan' --}}
        @yield('title','mchan')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' rel='stylesheet'>

    <link href='/css/mchan.css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    <header>
        <div class='logo'>
            <a href='/'>
            <img
            src='http://making-the-internet.s3.amazonaws.com/laravel-foobooks-logo@2x.png'
            style='width:300px'
            alt='Foobooks Logo'>
            </a>
        </div>

        <nav>
            <ul>
                <div class='setting'>
                    @if(Auth::check())
                        <li><a href='/account'>Account</a></li>
                        <li><a href='/logout'>Logout {{$user->name}}</a></li>
                    @else
                        <li><a href='/login'>Login</a></li>
                        <li><a href='/register'>Register</a></li>
                    @endif
                </div>
            </ul>
        </nav>
    </header>

    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>

    <footer>
        &copy; {{ date('Y') }} &nbsp;&nbsp;
        <a href='https://github.com/mtan810/p4' class='fa fa-github' target='_blank'> View on Github</a> &nbsp;&nbsp;
        <a href='http://p4.dwa16-masontan.me/' class='fa fa-link' target='_blank'> View Live</a>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    {{-- Yield any page specific JS files or anything else you might want at the end of the body --}}
    @yield('body')

</body>
</html>