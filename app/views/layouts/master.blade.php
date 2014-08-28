<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>

    <link rel="shortcut icon" type="image/x-icon" href="http://cdn.nhle.com/mapleleafs/v2/images/favicon.ico"></link>
    {{ HTML::style('assets/css/style.css') }}
    {{ HTML::script('http://code.jquery.com/jquery-2.1.1.min.js') }}
</head>
<body>
    <div class="page-wrap">        
        @yield('content')
    </div>

    <script>
        (function($) {
            var month;

            $('.schedule-month-header').on('click', function(e) {
                month = $(this).data('month');
                console.log(month);

                $('.schedule-row[data-month="' + month + '"]').toggleClass('collapsed');
            });

        })(jQuery);
    </script>
</body>
</html>