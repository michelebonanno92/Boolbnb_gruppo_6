
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
                <option value="24h" data-price="2.99">24 ore - €2,99</option>
                <option value="72h" data-price="5.99">72 ore - €5,99</option>
                <option value="144h" data-price="9.99">144 ore - €9,99</option>
            </select>
        </div>

        <div id="dropin-container" class="mb-3"></div>

        <input type="hidden" id="payment_method_nonce" name="payment_method_nonce">
        <input type="hidden" id="amount" name="amount" value="2.99"> <!-- Importo di default -->

        <button type="submit" class="btn btn-primary">Paga e Sponsorizza</button>
    </form>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
<script>
    braintree.dropin.create({
        authorization: '{{ $clientToken }}',  // Il token di autorizzazione Braintree
        container: '#dropin-container'  // Contenitore dove Braintree mostra la UI per la carta
    }, function (createErr, instance) {
        if (createErr) {
            console.error('Errore nella creazione del sistema di pagamento:', createErr);
            alert('Errore nel caricamento del sistema di pagamento.');
            return;
        }

        var form = document.querySelector('form');
        var nonceInput = document.querySelector('#payment_method_nonce');
        var amountInput = document.querySelector('#amount');
        var packageSelect = document.querySelector('#package');

        // Aggiungi un evento di cambio per aggiornare l'importo in base al pacchetto selezionato
        packageSelect.addEventListener('change', function () {
            var selectedPackage = packageSelect.options[packageSelect.selectedIndex];
            var price = selectedPackage.getAttribute('data-price');
            amountInput.value = price; // Aggiorna l'importo con il prezzo del pacchetto selezionato
        });

        // Gestisci l'invio del form
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Evita l'invio immediato del form

            // Richiedi il metodo di pagamento (generazione del nonce)
            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.error('Errore nella richiesta del metodo di pagamento:', err);
                    alert('Errore durante la richiesta del metodo di pagamento.');
                    return;
                }

                // Assicurati che il nonce venga inserito nel campo nascosto
                nonceInput.value = payload.nonce;

                // Dopo aver ricevuto il nonce, invia il form
                form.submit();  // Ora puoi inviare il form con il nonce
            });
        });
    });
</script>


@endsection

