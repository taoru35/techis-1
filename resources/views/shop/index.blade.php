@php
    use Illuminate\Support\Str;  // Strファサードを使用するための記述
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オンラインショップ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>オンライン商品一覧</h1>
                <!-- ショッピングカートへのリンク（実装時に適切なリンクに変更） -->
                <a href="/cart" class="btn btn-primary">カートを見る</a>
            </div>

            <div class="row">
                @foreach ($items as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="position-relative">
                            <img src="{{ env('AWS_URL') . '/' . $item->image }}" alt="{{ $item->name }}" class="w-100 img-fluid mx-auto d-block" style="max-width: 150px; max-height: 150px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ Str::limit($item->detail, 100, '...') }}</p>  {{-- 詳細の表示を100文字に制限 --}}
                            <p class="card-text">¥{{ number_format($item->price) }}</p>
                        </div>
                        <div class="card-footer">
                            <!-- カートに追加の機能を有効にする -->
                            <form action="{{ route('cart.add', $item) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-success w-100" value="カートに追加">
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
