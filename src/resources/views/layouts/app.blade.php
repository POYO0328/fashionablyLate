<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
     <div class="header-utilities">
        <a class="header__logo" href="/">
          FashionablyLate
        </a>
       <nav>
         <ul class="header-nav">
           <!-- <li class="header-nav__item">
             <a class="header-nav__link" href="/categories">カテゴリ一覧</a>
           </li> -->
           @if (Auth::check())
          <li class="header-nav__item">
              <form class="form" action="/logout" method="post">
                @csrf
                <button class="header-nav__button">logout</button>
              </form>
          </li>
          @endif
         </ul>
       </nav>
     </div>
    </div>
  </header>
  <main>
    @yield('content')
  </main>
</body>

</html>

