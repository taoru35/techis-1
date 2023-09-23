@extends('adminlte::page')

@section('title', '通知の投稿')

@section('content_header')
    <h1>通知の投稿</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">新しい通知を作成</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('notifications.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="type">通知タイプ <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="product_management">商品管理</option>
                        <option value="user_management">ユーザー管理</option>
                        <option value="important_notice">その他の重要な通知</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">タイトル <span class="text-danger">*</span> (最大30文字)</label>
                    <input type="text" name="title" id="title" class="form-control" maxlength="30" required>
                </div>
                <div class="form-group">
                    <label for="content">内容 <span class="text-danger">*</span> (最大255文字)</label>
                    <textarea name="content" id="content" class="form-control" rows="5" maxlength="255" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">投稿</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{-- 必要な場合、追加のCSSをこちらに --}}
@stop

@section('js')
    {{-- 必要な場合、追加のJavaScriptをこちらに --}}
@stop
