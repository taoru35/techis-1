<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $item->name }} - オンラインショップ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>

@include('partials.navbar')

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <a href="{{ route('shop.index') }}" class="btn btn-secondary mb-4">商品一覧に戻る</a>

            <div class="row">
                <div class="col-md-6">
                    <img src="{{ env('AWS_URL') . '/' . $item->image }}" alt="{{ $item->name }}" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2>{{ $item->name }}</h2>
                    <p>{{ $item->detail }}</p>
                    <p>¥{{ number_format($item->price) }}</p>

                    <form action="{{ route('cart.add', $item) }}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-success" value="カートに追加">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
