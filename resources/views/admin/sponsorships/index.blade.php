@extends('layouts.app')

@section('page-title', 'Sponsorizzazioni')

@section('main-content')

<div class="container">
    <h2>Sponsorizza il tuo appartamento</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</div>
    @endif

    <form method="POST" action="{{ route('admin.sponsorships.store') }}">
        @csrf

        <div class="mb-3">
            <label for="apartment_id" class="form-label">Seleziona Appartamento:</label>
            <select name="apartment_id" id="apartment_id" class="form-control">
                @foreach ($apartments as $apartment)
                    <option value="{{ $apartment->id }}">{{ $apartment->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="package" class="form-label">Seleziona Pacchetto:</label>
            <select name="package" id="package" class="form-control">
                <option value="24h">24 ore - €2,99</option>
                <option value="72h">72 ore - €5,99</option>
                <option value="144h">144 ore - €9,99</option>
            </select>
        </div>

        <div id="dropin-container" class="mb-3"></div>

        <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
        
        <button type="submit" class="btn btn-primary">Paga e Sponsorizza</button>
    </form>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('form');
    var nonceInput = document.querySelector('#payment_method_nonce');

    braintree.dropin.create({
        authorization: '{{ $clientToken }}',
        container: '#dropin-container'
    }, function (createErr, instance) {
        if (createErr) {
            console.error('Dropin Create Error:', createErr);
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.error('Request Payment Method Error:', err);
                    return;
                }

                nonceInput.value = payload.nonce;
                form.submit();
            });
        });
    });
</script> 

@endsection
