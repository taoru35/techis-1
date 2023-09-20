@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4"></h2>

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
                @foreach($cartItems as $item)
                    @php
                        $taxExcludedPrice = $item->price;
                        $totalTaxExcluded = $taxExcludedPrice * (isset($item->pivot) ? $item->pivot->quantity : 0);
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

        <!-- ここに決済手段の選択や住所の入力など、チェックアウトに関連するフォーム要素を追加できます。 -->

        <form action="{{ route('checkout.store') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-primary">購入する</button>
        </form>

    @else
        <p>カートにアイテムがありません。</p>
    @endif
</div>
@endsection
