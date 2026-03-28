<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Property Match</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/about.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/add-property.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/calculator.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/property-detail.css') }}">






</head>

<body>
{{ $slot }}
<script src="{{ asset('js/script.js') }}"></script>
{{-- <script>

    window.addEventListener('mouseover', initLandbot, { once: true });

    window.addEventListener('touchstart', initLandbot, { once: true });

    var myLandbot;

    function initLandbot() {

        if (!myLandbot) {

            var s = document.createElement('script');

            s.type = "module"

            s.async = true;

            s.addEventListener('load', function() {

                var myLandbot = new Landbot.Livechat({

                    configUrl: 'https://storage.googleapis.com/landbot.online/v3/H-2994092-87MC7JYGJPYQ3VW0/index.json',

                });

            });

            s.src = 'https://cdn.landbot.io/landbot-3/landbot-3.0.0.mjs';

            var x = document.getElementsByTagName('script')[0];

            x.parentNode.insertBefore(s, x);

        }

    }

</script> --}}
</body>

</html>
