<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tile</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</head>
<body class="bg-blue-100">
    
    @yield('main_content')


    <footer>

        @if ($errors->any() or session('message'))

    <div class="l-modal is-hidden--off-flow js-modal-shopify">
        <div class="l-modal__shadow js-modal-hide"></div>
        <div class="c-popup l-modal__body dropshadow-5">
            @if(session('message'))
            <h3 class="heading-3">{{ session('message') }}</h3>
            @elseif($errors->any())
            <h1 class="heading-3 u-margin-bottom-small">{{ __('footer.correct') }}</h1>
            <ul class="paragraph-regular__light">
                @foreach ($errors->all() as $error)
                <li class="u-margin-bottom-small">{!! $error !!}</li>
                @endforeach
            </ul>
            @endif
            <p class="popup-close" id="close-alert-button"><img src="/img/svg/close.svg" alt="An x to close the window"></p>
        </div>
    </div>

    <script>
        //***********
        // This is the alert box function 
        //***********
        $('.js-modal-shopify').toggleClass('is-shown--off-flow').toggleClass('is-hidden--off-flow');
        $('.js-modal-hide').click(function(){
        $('.js-modal-shopify').toggleClass('is-shown--off-flow').toggleClass('is-hidden--off-flow');
        });
        document.getElementById("close-alert-button").onclick = function() {
            $('.js-modal-shopify').toggleClass('is-shown--off-flow').toggleClass('is-hidden--off-flow');
            };
    </script>

@endif


    </footer>

</body>
</html>