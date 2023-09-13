@extends('adminlte::page')

@section('title', 'カスタマー登録')

@section('content_header')
    <h1>カスタマー登録</h1>
@stop

@section('content')
    <!-- バリデーションエラーメッセージ表示部分 -->
    @if ($errors->any())
       <div class="alert alert-danger">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <!-- ユーザー情報の入力部分 -->
        <div class="form-group">
            <label for="nickname">ニックネーム <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nickname" name="nickname" required value="{{ old('nickname') }}">
        </div>


        <div class="form-group">
            <label for="email">メールアドレス <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">パスワード <span class="text-danger">*</span> (8文字以上)</label>
            <input type="password" class="form-control" id="password" name="password" required minlength="8">
        </div>
        <div class="form-group">
            <label for="password_confirmation">パスワードの確認 <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8">
        </div>

        <!-- カスタマー情報の入力部分 -->
        <div class="form-group">
            <label for="full_name">フルネーム <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="full_name" name="full_name" required value="{{ old('full_name') }}">
        </div>
        <div class="form-group">
            <label for="address">住所 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="address" name="address" required value="{{ old('address') }}">
        </div>
        <div class="form-group">
            <label for="phone_number">電話番号 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required value="{{ old('phone_number') }}">
        </div>

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@stop
