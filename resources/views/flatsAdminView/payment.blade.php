<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="user-id"
    @if (Auth::user() != null)
        content="{{ Auth::user()->id }}"
    @endif >

    <title>Laravel</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

</head>

<body>
    @yield('payment')
    <div id="payment-container" class="container disabled-payment">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container"></div>
                <button id="submit-button" v-on:click="changeFlag()">Request payment method</button>
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
            container: '#dropin-container'
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
                                alert('Payment successfull!');
                                location.reload();
                            } else {
                                alert('Payment failed');
                            }
                        }, 'json');
                });
            });
        });
    </script>
</body>

</html>
