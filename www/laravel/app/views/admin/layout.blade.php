<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    {{HTML::style(asset('assets/css/bootstrap.min.css'))}}
    {{HTML::style(asset('assets/css/main.css'))}}
    {{HTML::script('http://code.jquery.com/jquery-1.10.1.min.js')}}
    {{HTML::script('http://code.jquery.com/jquery-migrate-1.2.1.min.js')}}
    {{HTML::script(asset('assets/js/bootstrap.min.js'))}}
    <!--
        http://bootsnipp.com/snippets/featured/google-style-login
        http://bootsnipp.com/snippets/featured/recent-comments-admin-panel
        http://bootsnipp.com/snippets/featured/admin-panel-quick-shortcuts
    -->
<title>Jasmine Administration Section</title>
</head>
<body>
<div class="container">
    @yield('body')
</div>
</body>
</html>