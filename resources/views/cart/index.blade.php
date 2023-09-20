@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">ショッピングカート</h2>

    @if(!is_null($cartItems) && count($cartItems) > 0)
        <table class="table table-bordered">
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
                        <td>
                            <div class="d-flex align-items-center">
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
                                <button type="submit" class="btn btn-danger btn-sm">カートから削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">購入画面に進む</a>
        </div>

    @else
        <p>カートにアイテムがありません。</p>
    @endif
</div>
@endsection
