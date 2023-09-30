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
        <h4 class="mb-3">カートの中身</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>アイテム名</th>
                    <th>価格(税抜き)</th>
                    <th>数量</th>
                    <th>合計(税抜き)</th>
                </tr>
            </thead>
            <tbody>
                @php
                $grandTotal = 0;
                @endphp
                @foreach($cartItems as $item)
                    @php
                        $taxExcludedPrice = $item->price;
                        $totalTaxExcluded = $taxExcludedPrice * (isset($item->pivot) ? $item->pivot->quantity : 0);
                        $grandTotal += $totalTaxExcluded;
                    @endphp
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            {{ number_format($taxExcludedPrice * 1.10, 0) }}円
                            ({{ number_format($taxExcludedPrice, 0) }}円)
                        </td>
                        <td>{{ isset($item->pivot) ? $item->pivot->quantity : '' }}</td>
                        <td>
                            {{ number_format($totalTaxExcluded * 1.10, 0) }}円
                            ({{ number_format($totalTaxExcluded, 0) }}円)
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <h4>全商品の合計: <span style="color: red; font-weight: bold; background-color: #ffe5e5; padding: 3px;">{{ number_format($grandTotal * 1.10, 0) }}円</span> (税込)</h4>

            <div class="mt-4">
                <h4>全商品の合計: <span style="color: red; font-weight: bold; background-color: #ffe5e5; padding: 3px;">{{ number_format($grandTotal * 1.10, 0) }}円</span> (税込)</h4>
            </div>

            <div class="card bg-light mt-4 p-4">
                <h4 class="mb-3">お支払い情報</h4>

                <form action="{{ route('checkout.store') }}" method="post" id="payment-form">
                    @csrf

                    <!-- クレジットカード情報の入力フォーム -->
                    <div class="form-group">
                        <label for="card-element" class="font-weight-bold">
                            クレジットカード情報
                        </label>
                        <div class="py-3 px-2 border rounded" style="background-color: #f9f9f9;">
                            <div id="card-element"></div>
                        </div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block mt-4">購入する</button>
                </form>
            </div>

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
