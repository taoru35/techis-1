@extends('adminlte::page')

@section('title', '商品管理システム')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- 統計情報の表示 -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">登録顧客数</span>
                    <span class="info-box-number">{{ $userCount }}</span>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-box"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">商品総数</span>
                    <span class="info-box-number">{{ $itemCount }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">商品管理</h3>
        </div>
        <div class="card-body">
            <p>(仮) 最新の商品や通知をこちらに表示します。</p>
            <p>(仮) 在庫が少ない商品: アイテムA, アイテムB, アイテムC</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ユーザー管理</h3>
        </div>
        <div class="card-body">
            <p>(仮) ユーザー関連の情報や通知をこちらに表示します。</p>
            <p>(仮) 過去24時間で新たに登録されたユーザー: 5人</p>
        </div>
    </div>

    <!-- リアルタイムの通知やアラート -->
    <div class="alert alert-danger" role="alert">
        重要な通知やアラートをこちらに表示します。
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
