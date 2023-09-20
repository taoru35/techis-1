<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チェックアウト</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
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

        </div>

        <!-- ここに決済手段の選択や住所の入力など、チェックアウトに関連するフォーム要素を追加できます。 -->

        <form action="{{ route('checkout.store') }}" method="post" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: #2491f0f8;">購入する</button>
        </form>

    @else
        <p>カートにアイテムがありません。</p>
    @endif

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
