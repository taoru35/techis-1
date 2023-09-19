<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Salon(テック美容室)</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- 新しく追加した外部CSSファイルへのリンク -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('salon.homepage') }}">Tech Salon（テック美容室）</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('salon.homepage') }}">Home</a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Stylists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Testimonials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>

            @if(Auth::check())
            <!-- ログインしている場合のドロップダウンメニュー部分 -->
            <li class="nav-item dropdown ml-4">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #f5f5f5; border-radius: 5px;">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </li>
            @else
            <!-- ログインしていない場合の新規登録リンク -->
            <li class="nav-item ml-4">
                <a class="nav-link" href="{{ route('register') }}" style="background-color: #f5f5f5; border-radius: 5px;">新規登録</a>
            </li>
            @endif
        </ul>
    </div>
</nav>

@if(Auth::check())
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
@endif





    <!-- Main Image -->
    <div class="main-image d-flex justify-content-center align-items-center text-white">
        <div class="overlay"></div>
        <h1>Welcome to Tech Salon</h1>
    </div>


<!-- Services Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="feature-box">
                <h4>Haircut & Styling</h4>
                <p>Get a refreshing haircut and style by our experienced stylists.</p>
            </div>
        </div>
        <!-- Repeat for other services -->
    </div>
</div>

<!-- Testimonials -->
<div class="container mt-5">
    <h2 class="text-center mb-5">Our Happy Customers</h2>
    <div class="testimonial">
        <p>"Absolutely loved the service. Best haircut ever!"</p>
        <p><strong>- Maria K.</strong></p>
    </div>
    <!-- Add more testimonials as needed -->
</div>

 <!-- Footer -->
 <footer class="text-center">
    &copy; 2023 Tech Salon. All rights reserved.
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.overlay').css('background-color', 'rgba(0, 0, 0, 0.4)');
        }, 500); // 2秒後に実行
    });
</script>
</body>

</html>






