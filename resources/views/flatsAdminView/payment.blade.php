<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="user-id"
    @if (Auth::user() != null)
        content="{{ Auth::user()->id }}"
    @endif >

    {{-- favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon_package_v0.16/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon_package_v0.16/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon_package_v0.16/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon_package_v0.16/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon_package_v0.16/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Macaco B&B - Sponsor</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

    <!-- Boostrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</head>
    <body id="bodyPayment123456789">
        <div class="bnb-pageWrapper">
            <div class="bnb-navWide">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                    <div class="container bnb-container">
                        <div class="bnb-logoContainer">
                            <div class="bnb-brandName">
                                <span>Macaco B&B</span>
                            </div>
                            <a class="logo" href="{{ url('/') }}">
                                <img src="{{asset('imageOfPage/macaco-bnb-logo.png')}}" alt="">
                            </a>
                        </div>

                        {{-- burger menu button --}}
                        <button class="navbar-toggler bnb-buttonStyle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        {{-- menu a tendina --}}
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                    <a class="nav-link" href="{{ url('/') }}">
                                    Home
                                    </a>
                                </li>

                                <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                    <a class="nav-link" href="{{ route("public.flats.search") }}">
                                    <i class="fas fa-search"></i>
                                    <span>Cerca</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav ml-auto bnb-mlAuto-payment">
                                <!-- Authentication Links -->
                                @guest
                                    <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                        <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item bnb-textContainer  bnb-burgerMenu">
                                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                        Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown  bnb-burgerMenu">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right bnb-burgerMenu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
            <div class="container bnb-totalMain">
                {{-- yield degli sponsor --}}
                <div class="bnb-mainPayment">
                    @yield('payment')
                </div>
                {{-- container pagamento --}}
                <div id="payment-container" class="container disabled-payment">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <div id="dropin-container"></div>
                            <button class="btn btn-dark" id="submit-button">Invia Pagamento</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var button = document.querySelector('#submit-button');
                var flat = {{ $flat->id }};
                var radioButtons = document.getElementsByClassName('sponsor-type');
                for (let y = 0; y < radioButtons.length; y++) {
                    radioButtons[y].addEventListener('click', function(){
                        document.getElementById('payment-container').classList.remove('disabled-payment')
                    })
                }

                var value;

                braintree.dropin.create({
                    authorization: "{{ Braintree\ClientToken::generate() }}",
                    container: '#dropin-container',
                    translations: {
                        payWithCard: 'Pagamento con Carta di Credito/Debito',
                        cardNumberLabel: 'Numero Carta',
                        expirationDateLabel: 'Data Di Scadenza',
                        expirationDateLabelSubheading: '(MM/AA)',
                        expirationDatePlaceholder: 'MM/AA',
                        fieldEmptyForNumber: 'Iserire il numero della carta.',
                        fieldInvalidForNumber: 'Il numero della carta non è valido.',
                        fieldEmptyForExpirationDate: 'Inserire la data di scadenza della carta.',
                        fieldInvalidForExpirationDate: 'La data di scadenza non è valida.',
                        hostedFieldsFieldsInvalidError: 'Per favore controlla i dati inseriti e riprova.'

                    }
                }, function(createErr, instance) {
                    button.addEventListener('click', function() {
                        for (let x = 0; x < radioButtons.length; x++) {
                            if (radioButtons[x].checked) {
                                value = radioButtons[x].value;
                            }
                        }
                        instance.requestPaymentMethod(function(err, payload) {
                            $.get('{{ route('payment.make') }}', {
                                    payload,
                                    value,
                                    flat
                                },
                                function(response) {
                                    if (response.success) {
                                        alert('Pagamento avvenuto con sucesso!');
                                    } else {
                                        alert('Transazione fallita, riprova piu tardi!');
                                    }
                                    location.reload();
                                }, 'json');
                        });
                    });
                });
            </script>
            <footer >
                <div class="container bnb-container">
                    <div class="col-lg-9 bnb-creditsContainer">
                        <div class="bnb-creaditsCreators">
                            Macaco B&B is
                            created by team 6 with &hearts;
                            boolean class #25 &copy; ADGGD
                        </div>
                    </div>
                    {{--
                        sezione contatti social con link esterni alle rispettive pagine
                    --}}
                    <div class="col-lg-3 bnb-rightFoot">
                        <a href="https://www.facebook.com">
                            <i class="fab fa-facebook-square"></i>
                        </a>
                        <a href="https://www.instagram.com">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.twitter.com">
                            <i class="fab fa-twitter-square"></i>
                        </a>
                        <a href="https://www.linkedin.com">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </body>

</html>
