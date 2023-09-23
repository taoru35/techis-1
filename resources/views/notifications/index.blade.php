@extends('adminlte::page')

@section('title', '通知一覧')

@section('content_header')
    <h1>通知一覧</h1>
@stop

@section('content')
    @php
        $notificationTypeMapping = [
            'product_management' => '商品管理',
            'user_management' => 'ユーザー管理',
            'important_notice' => 'その他の重要な通知'
        ];
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">すべての通知</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <div class="input-group-append">
                        <a href="{{ url('notifications/create') }}" class="btn btn-default">通知投稿</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>タイプ</th>
                        <th>タイトル</th>
                        <th>内容</th>
                        <th>投稿日時</th>
                        <!-- 必要であれば、編集や削除のボタンも追加できます -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notification)
                    <tr>
                        <td>{{ $notification->id }}</td>
                        <td>{{ $notificationTypeMapping[$notification->type] ?? $notification->type }}</td>
                        <td>{{ $notification->title }}</td>
                        <td>{{ $notification->content }}</td>
                        <td>{{ $notification->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    {{-- 必要な場合、追加のCSSをこちらに --}}
@stop

@section('js')
    {{-- 必要な場合、追加のJavaScriptをこちらに --}}
@stop
