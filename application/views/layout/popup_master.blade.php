<!DOCTYPE html>
<html>
    <head>
        @render('layout.partials.head_content')
    </head>
    <body>

        <div id="wrap">

            @render('layout.partials.navbar')

            <div class="container">
                @yield('container')
            </div>

        </div>

        {{ Asset::scripts() }}
        @yield('javascript')

    </body>
</html>
