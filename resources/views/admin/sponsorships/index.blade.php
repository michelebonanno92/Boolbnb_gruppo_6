
@extends('layouts.app')

@section('page-title', 'Sponsorizza Appartamento')

@section('main-content')

<div class="container">
    <h2>Sponsorizza il tuo appartamento</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</div>
    @endif

    <form method="POST" action="{{ route('admin.sponsorships.store') }}" id="payment-form">
        @csrf

        <div class="mb-3">
            <label for="apartment_id" class="form-label">Seleziona Appartamento:</label>
            <select name="apartment_id" id="apartment_id" class="form-control">
                @foreach ($apartments as $apartment)
                    <option value="{{ $apartment->id }}" 
                        @if ($apartment->id == $selectedApartmentId) selected @endif>
                        {{ $apartment->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sponsorship">Pacchetto Sponsorizzazione:</label>
            <select name="sponsorship_id" id="sponsorship" class="form-control">
                @foreach($sponsorships as $sponsorship)
                    <option value="{{ $sponsorship->id }}">
                        {{ $sponsorship->name }} ({{ $sponsorship->price }} €)
                    </option>
                @endforeach
            </select>
        </div>

        <div id="dropin-container" class="mb-3"></div>

        <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
        <input type="hidden" id="amount" name="amount" value="2.99"> <!-- Importo di default -->
        <a href="{{ route('admin.apartments.index') }}" class="btn btn-outline-secondary">Indietro</a>
        <button type="submit" class="btn btn-primary">Paga e Sponsorizza</button>
    </form>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script>
    
    var form = document.getElementById('payment-form');
    var clientToken = "{{ $clientToken }}";

    braintree.dropin.create({
        authorization: clientToken,
        container: '#dropin-container'
    }, function (err, instance) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            instance.requestPaymentMethod(function (err, payload) {
                document.getElementById('payment_method_nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>


@endsection

