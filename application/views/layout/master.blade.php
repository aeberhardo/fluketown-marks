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
            <br/>

            <div id="push"></div>
        </div>

        @render('layout.partials.footer')

        {{ Asset::scripts() }}
        @yield('javascript')

    </body>
</html>
