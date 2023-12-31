@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@php
    use Illuminate\Support\Str;  // Strファサードを使用するための記述
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0 overflow-auto" style="max-height: 500px;">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <th>画像</th>
                                <th>価格</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ Str::limit($item->name, 40, '...') }}</td>

                                    <td>{{ $item->type }}</td>
                                    <td>{{ Str::limit($item->detail, 40, '...') }}</td>
                                    <td>
                                        <img src="{{ env('AWS_URL') . '/' . $item->image }}" alt="{{ $item->name }}" width="30">
                                    </td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <div class="btn-group">
                                            {{-- 編集ボタン --}}
                                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">編集</a>

                                            {{-- 削除ボタン --}}
                                            <form action="{{ route('items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
