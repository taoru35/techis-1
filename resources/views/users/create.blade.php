@extends('adminlte::page')

@section('title', 'ユーザー登録')

@section('content_header')
    <h1>ユーザー登録</h1>
@stop

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">名前 <span class="text-danger">*</span> (最大30文字)</label>
            <input type="text" class="form-control" id="name" name="name" required maxlength="30" value="{{ old('name') }}">
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
        <!-- ロール選択の部分を追加 -->
        <div class="form-group">
            <label for="role">ロール <span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role">
                <option value="user">一般ユーザー</option>
                <option value="staff">スタッフ</option>
                <option value="admin">管理者</option>
            </select>
        </div>
        <!-- 追加終わり -->

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@stop
