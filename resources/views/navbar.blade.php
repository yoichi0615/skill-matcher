  <div class="container">
    <div class="fixed-top head navbar-fixed-top">
      <nav class="navbar navbar-expand navbar-dark bg-info head fixed-top navbar-fixed-top">
        <a href="#" class="navbar-brand">skill-matcher</a>
        <ul class="navbar-nav">
          <li class="nav-item"><a href="#" class="nav-link">ホーム</a></li>
          <li class="nav-item">
            @auth
            <a href="{{route('post.create')}}" class="nav-link">投稿</a>
            @endauth
            @guest
            <a href="{{route('login')}}" class="nav-link">投稿</a>
            @endguest
          </li>
          <li class="nav-item"><a href="#" class="nav-link">予約</a></li>
        </ul>
        <form class="form-inline ml-auto" method="GET" action="{{ route('index') }}">
          <label class="sr-only" for="keyword">サイト内検索</label>
          <input type="search" class="form-control form-control-sm mr-2" placeholder="検索ワード" id="keyword" name="keyword" value="@if (isset($keyword)) {{ $keyword }} @endif">
          <button type="submit" class="btn btn-warning btn-sm">検索</button>
        </form>
          <a href="{{ route('register') }}"><i class="bi bi-person-circle"></i></a>
          @if( \Auth::check() )
          <span>{{ \Auth::user()->name }}</span>
          <form action="{{ route('logout')}}" method="POST">
            @csrf
            <button type="submit">ログアウト</button>
          </form>
          @else
          <a href="{{ route('register') }}">ユーザー登録</a>
          @endif
      </nav>
    </div>
  </div>