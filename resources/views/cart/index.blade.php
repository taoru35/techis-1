<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ショッピングカート</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
@include('partials.navbar')

<div class="container mt-5">
    <h2 class="my-4">ショッピングカート</h2>

    @if(!is_null($cartItems) && count($cartItems) > 0)
        <table class="table table-bordered table-responsive-sm">
            <thead>
                <tr>
                    <th>アイテム名</th>
                    <th>価格(税抜き)</th>
                    <th>数量</th>
                    <th>合計(税抜き)</th>
                    <th>アクション</th>
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
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <form action="{{ route('cart.increaseQuantity', $item) }}" method="post" class="mr-2">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-success btn-sm">+</button>
                                </form>

                                {{ isset($item->pivot) ? $item->pivot->quantity : '' }}

                                <form action="{{ route('cart.decreaseQuantity', $item) }}" method="post" class="ml-2">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger btn-sm">-</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            {{ number_format($totalTaxExcluded * 1.10, 0) }}円
                            ({{ number_format($totalTaxExcluded, 0) }}円)
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $item) }}" method="post" onsubmit="return confirm('このアイテムをカートから削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-block">カートから削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            <h4>全商品の合計: <span class="text-danger font-weight-bold bg-light p-2">{{ number_format($grandTotal * 1.10, 0) }}円</span> (税込)</h4>
        </div>

        <div class="mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block" style="background-color: #2491f0f8;">購入画面に進む</a>
        </div>

    @else
        <p>カートにアイテムがありません。</p>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
