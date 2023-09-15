@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前 <span class="text-danger">*</span> (最大100文字)</label>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="100" placeholder="名前" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="type" name="type" required placeholder="種別" value="{{ old('type') }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細 <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="detail" name="detail" required placeholder="詳細説明">{{ old('detail') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">画像 <span class="text-danger">*</span> (JPEG, PNG, JPG, GIF / 最大2MB)</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                        <div class="form-group">
                            <label for="price">価格 <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="price" name="price" required placeholder="価格" value="{{ old('price') }}">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
