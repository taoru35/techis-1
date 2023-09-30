<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チェックアウト</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Stripe.jsライブラリを読み込み -->
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

@include('partials.navbar')

<div class="container mt-5">
    <h2 class="my-4">購入商品確認画面</h2>

    @if(!is_null($cartItems) && count($cartItems) > 0)
        <!-- ... 既存のカート表示コード ... -->

        <form action="{{ route('checkout.store') }}" method="post" id="payment-form" class="mt-3">
            @csrf

            <!-- クレジットカード情報の入力フォーム -->
            <div class="form-group">
                <label for="card-element">
                    クレジットカード情報
                </label>
                <div id="card-element"></div>
                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
            </div>

            <button type="submit" class="btn btn-primary" style="background-color: #2491f0f8;">購入する</button>
        </form>

    @else
        <p>カートにアイテムがありません。</p>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    var stripe = Stripe('pk_test_51NqoaULML00WK7RX3QKujDunU7N3QpMlpJtFeVmZtCHE6mght7knZk4RnErzBA0Ac3uVgTyZI7UCMHcVWrszMtkd00QIiulrPl');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', result.token.id);
                form.appendChild(hiddenInput);
                form.submit();
            }
        });
    });
</script>

</body>
</html>
