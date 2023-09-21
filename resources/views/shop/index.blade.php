<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>オンラインショップ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"><!-- 必要に応じて追加 -->

</head>

<body>

<!-- Navbar -->
@include('partials.navbar')

<div class="container mt-5">

<!-- フィルタリング & 検索部分 -->
<form action="{{ route('shop.index') }}" method="get" class="mb-4 d-flex align-items-center">
    <div class="mr-3">
        <select name="type" class="form-control">
            <option value="">全てのタイプ</option>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="mr-3">
        <input type="text" name="search" class="form-control" placeholder="商品名やキーワードで検索" value="{{ request('search') }}">
    </div>
    <button type="submit" class="btn btn-info">検索 & フィルタリング</button>
</form>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>オンライン商品一覧</h1>
                <a href="{{ route('cart.index') }}" class="btn btn-primary">カートを見る</a>
            </div>

            <div class="row">
                @foreach ($items as $item)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ env('AWS_URL') . '/' . $item->image }}" alt="{{ $item->name }}" class="card-img-top" style="max-width: 150px; max-height: 150px; display: block; margin-left: auto; margin-right: auto;">

                        <div class="card-body">
                            <h5 class="card-text">{{ Str::limit($item->name , 50, '...') }}</h5>
                            <p class="card-text">{{ Str::limit($item->detail, 50, '...') }}</p>
                            <p class="card-text">¥{{ number_format($item->price) }}</p>
                        </div>
                        <div class="card-footer">
                            <form action="{{ route('cart.add', $item) }}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-success w-100" value="カートに追加">
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


            <!-- ページネーションリンクの追加 -->
            <div class="mt-4 d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="{{ $items->previousPageUrl() }}">前へ</a></li>
                        @for ($i = 1; $i <= $items->lastPage(); $i++)
                            <li class="page-item @if ($i == $items->currentPage()) active @endif">
                                <a class="page-link" href="{{ $items->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="{{ $items->nextPageUrl() }}">次へ</a></li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
