@extends('adminlte::page')

@section('title', 'カスタマー一覧')

@section('content_header')
    <h1>カスタマー一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">

            <!-- 成功メッセージを表示 -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">カスタマー一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">

                                <a href="{{ route('customers.create') }}" class="btn btn-default">カスタマー追加</a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>フルネーム</th>
                                <th>住所</th>
                                <th>電話番号</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->full_name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone_number }}</td>
                                <td>
                                    <!-- 削除ボタン -->
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                    </form>
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
