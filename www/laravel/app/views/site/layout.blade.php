<!DOCTYPE html>
<html lang="en">
<head>
    <!-- http://startbootstrap.com/business-casual -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasmine Blog - Laravel and Parse.com Data in harmony</title>
    <!-- Bootstrap core CSS -->
    {{HTML::style(asset('assets/css/bootstrap.css'))}}
    <!-- Add custom CSS here -->
    {{HTML::style(asset('assets/css/business-casual.css'))}}
</head>

<body>

<div class="brand">Jasmine Blog</div>
<div class="address-bar">Laravel and Parse.com Data in harmony</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">Business Casual</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{URL::action('HomeController@getIndex')}}">Home</a></li>
                <li><a href="{{URL::route('login')}}">Login</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>

<div class="container">
    @if(Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

    @yield('body')
</div><!-- /.container -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>All the code is Under The MIT License.</p>
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript -->
{{HTML::script('http://code.jquery.com/jquery-1.10.2.min.js')}}
{{HTML::script(asset('assets/js/bootstrap.min.js'))}}
</body>
</html>