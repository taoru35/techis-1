@extends('adminlte::page')

@section('title', 'ユーザー登録')

@section('content_header')
    <h1>ユーザー登録</h1>
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
        <div class="form-group">
            <label for="role">ロール <span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role">
                <option value="user">一般ユーザー</option>
                <option value="staff">スタッフ</option>
                <option value="admin">管理者</option>
            </select>
        </div>

        <!-- 顧客情報の入力部分 -->
        <div id="customerInfo" style="display: none;">
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
                <input type="text" class="form-control" id="phone_number" name="phone_number" required value="{{ old('phone_number') }}"
                       placeholder="例: 090-1234-5678" pattern="^\d{2,4}-\d{2,4}-\d{3,4}$">
                <small class="text-muted">半角数字とハイフンを使用してください (例: 03-1234-5678, 090-1234-5678)</small>
            </div>
        </div>
        <!-- 顧客情報の入力部分終わり -->

        <button type="submit" class="btn btn-primary">登録</button>
    </form>
@stop

@section('js')
<script>
    function toggleCustomerInfo() {
        const roleSelect = document.getElementById('role');
        const customerInfo = document.getElementById('customerInfo');

        if (roleSelect.value === 'user') {
            customerInfo.style.display = 'block';
        } else {
            customerInfo.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleCustomerInfo();

        document.getElementById('role').addEventListener('change', toggleCustomerInfo);
    });
</script>
@stop
