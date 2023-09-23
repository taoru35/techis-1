@extends('adminlte::page')

@section('title', '通知の編集')

@section('content_header')
    <h1>通知の編集</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">通知を編集</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('notifications.update', $notification->id) }}" method="post">
                @csrf
                @method('PUT')
                <!-- 以下はcreate.blade.phpの入力フォームとほぼ同じですが、value属性を使って既存のデータを表示します -->
                <!-- その他の部分は修正が不要です -->
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
