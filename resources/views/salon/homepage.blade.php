<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>美容室 Salon</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">美容室 Salon</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#about">紹介</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">サービス</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#reservation">予約</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">お問い合わせ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
  </form>

<!-- Hero Section -->
<section class="hero bg-light py-5">
  <div class="container text-center">
    <h1>美容室 Salon</h1>
    <p>あなたの美しさを引き出します。</p>
  </div>
</section>

<!-- About Section -->
<section id="about" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2>私たちについて</h2>
                <p>美容室 Salonは、あなたの美しさを最大限に引き出すプロフェッショナルなスタッフが揃っています。最新のトレンドや技術を取り入れ、お客様一人一人に合わせたスタイルを提案します。</p>
            </div>
            <div class="col-lg-6">
                <h4>店内の写真</h4>
                <img src="path/to/shop-image.jpg" alt="店内の写真" class="img-fluid mb-3">
                <h4>スタッフの写真</h4>
                <img src="path/to/staff-image.jpg" alt="スタッフの写真" class="img-fluid">
            </div>
        </div>
    </div>
</section>

</body>
</html>
<!-- Reservation Section -->
<section id="reservation" class="py-5">
  <div class="container">
      <div class="row">
          <div class="col-12 text-center">
              <h2>予約</h2>
              <p>以下のフォームからお気軽にご予約ください。</p>
          </div>
          <div class="col-lg-8 mx-auto">
              <form>
                  <div class="mb-3">
                      <label for="name" class="form-label">お名前</label>
                      <input type="text" class="form-control" id="name" required>
                  </div>
                  <div class="mb-3">
                      <label for="email" class="form-label">メールアドレス</label>
                      <input type="email" class="form-control" id="email" required>
                  </div>
                  <div class="mb-3">
                      <label for="date" class="form-label">希望日</label>
                      <input type="date" class="form-control" id="date" required>
                  </div>
                  <div class="mb-3">
                      <label for="service" class="form-label">サービス</label>
                      <select class="form-control" id="service">
                          <option>カット</option>
                          <option>カラーリング</option>
                          <option>パーマ</option>
                      </select>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-dark">予約する</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</section>
