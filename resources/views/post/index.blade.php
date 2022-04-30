@extends('layouts.app')
<style>
  .head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 1200px;
    margin: 0 auto;
    height: 70px;
  }
  .plan-card {
    position: relative;
    max-width: 270px;
    width: 100%;
    background: #fff;
    border-radius: 8px;
    border: 1px solid var(--c-gray-border);
    box-shadow: 0 2px 8px rgb(19 177 192 / 6%);
    margin-right: 17px;
}

/* .back_white {
  background-color: blue;
} */

.inner {
  max-width: 1200px;
  margin: 0 auto;
}

select {
  outline: none;
}

.search_plan {
  padding: 20px;
}

.condition {
  font-weight: 550;
}

.search_title {
  margin-top: 20px;
  /* font-size: 1rem; */
  font-weight: 550;
}

#q {
  width: 100%;
  background: #f4f8fa;
    margin: 0;
    border: none;
    border-radius: 0;
    outline: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding: 10px 20px;
    border-radius: 20px;
    width: 100%;
    box-sizing: border-box;
}

.drop {
  width: 100%;
}

.tagbox {
    font-size: 1rem;
    font-weight: 700;
}

.tag {
    padding: 2px 8px;
    font-size: .7rem;
    background: #f1f1f1;
    color: #0f939f;
    border: 1px solid hsla(0,0%,93.3%,.9333333333333333);
    margin: 0 2px 4px 0;
    border-radius: 2px;
    box-sizing: border-box;
    display: inline-block;
    cursor: pointer;
    text-decoration: none!important;
}

.left {
  width: 100%;
  margin-right: 25px;
  box-sizing: border-box;
  text-align: left;
  margin-top: 2rem !important;
}

.eye_catch {
  width: 100%;
    position: relative;
    /* overflow: hidden; */
    /* padding-top: 56%; */
    background: var(--c-gray-bg);
    margin-bottom: 0!important;
    height: 0;
    line-height: 0;
    z-index: 2;
}

.plan_text {
  padding: 16px;
  box-sizing: border-box;
}
}
</style>

@section('content')
{{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">Tasks</li>
    </ul>
  </div>
</nav> --}}
{{-- <example-component></example-component> --}}
<div class="back_white pt-3">
  <div class="mt-6 inner d-flex">
    <div class="left serch_box">
      <div class="card">
        <div class="search_plan">
          <h6 class="condition">条件で絞り込む</h6>
          <div class="serach_condition">
            <input type="text" placeholder="例）英語 PCスキルなど" id="q">
          </div>
          <div class="more">
            <div class="more_category">
              <div class="search_title">カテゴリー</div>
              <div class="form-group right">
                <div class="select">
                  <form action="{{ route('index') }}" method="GET">
                    <select name="keyword" id="choice" class="drop" onchange="submit(this.form)">
                      <option value="英語" @if($keyword == '英語') selected @endif>英語</option>
                      <option value="web制作" @if($keyword == 'web制作') selected @endif>web制作</option>
                      <option value="web開発" @if($keyword == 'web開発') selected @endif>web開発</option>
                      <option value="デザイン" @if($keyword == 'デザイン') selected @endif>デザイン</option>
                      <option value="" @if($keyword == 'ああ') selected @endif>マーケティング</option>
                      <option value="" @if($keyword == 'あ') selected @endif>恋愛</option>
                      <option value="" @if($keyword == 'あああ') selected @endif>歌</option>
                    </select>
                  </form>
                </div>
              </div>
              <div class="search_title">評価</div>
              <div class="form-group right">
                <div class="select">
                  <select name="" id="" class="drop">
                    <option value="" selected="selected">全て</option>
                    <option value="">★★★〜</option>
                    <option value="">★★★★〜</option>
                    <option value="">★★★★★〜</option>
                  </select>
                </div>
              </div>
              <div class="search_title">スキルタグ</div>
              <div class="inner flex tagbox">
                <a href="{{ route('index', ['keyword' => 'プログラミング']) }}" class="tag">プログラミング</a>
                <a href="" class="tag">web制作</a>
                <a href="" class="tag">デザイン</a>
                <a href="" class="tag">UI・UX</a>
                <a href="" class="tag">スマホアプリ</a>
                <a href="" class="tag">web開発</a>
                <a href="" class="tag">英会話</a>
                <a href="" class="tag">スポーツ</a>
                <a href="" class="tag">恋愛</a>
                <a href="" class="tag">アート</a>
                <a href="" class="tag">マーケティング</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="right d-flex flex-wrap mt-3">
      @foreach ($posts as $post)
      <div class="card m-3 p-content-card plan-card">
        <a href="{{route('post.show', ['id' => $post->id])}}">
          <div class="card-body">
            <div class="eye_catch">
              {{ $post->user->name }}
            </div>
            @foreach ($post->tags as $tag)
              @if ($loop->first)
              <div class="card-body pt-0 pb-4 pl-3">
                <div class="card-text line-height">
              @endif
              <a href="" class="border p-1 mr-1 mt-1 text-muted">
                {{ $tag->name }}
              </a>
              @if ($loop->last)
                </div>
              </div>
              @endif
            @endforeach
                  
            <div class="inner_card">
              <div class="plan_text">
                {{ $post->summary }}</br>
                ここに説明文とユーザーの写真、評価などが入ります。(下部)
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">魚介コース</h3>
          <p class="card-text">近くの市場からその日仕入れた魚介類を使ったコースです。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">贅沢コース</h3>
          <p class="card-text">高級食材を使用した贅沢なコースです。大切な日のお食事に是非。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">お手軽コース</h3>
          <p class="card-text">ボリュームを控えめにしたコースです。メインは３種類からお選びいただけます。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">おすすめコース</h3>
          <h6 class="card-subtitle mb-2">-季節の野菜を使用-</h6>
          <p class="card-text">シェフのおすすめコースです。季節ごとに内容は異なります。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">魚介コース</h3>
          <p class="card-text">近くの市場からその日仕入れた魚介類を使ったコースです。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">贅沢コース</h3>
          <p class="card-text">高級食材を使用した贅沢なコースです。大切な日のお食事に是非。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">お手軽コース</h3>
          <p class="card-text">ボリュームを控えめにしたコースです。メインは３種類からお選びいただけます。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">おすすめコース</h3>
          <h6 class="card-subtitle mb-2">-季節の野菜を使用-</h6>
          <p class="card-text">シェフのおすすめコースです。季節ごとに内容は異なります。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">魚介コース</h3>
          <p class="card-text">近くの市場からその日仕入れた魚介類を使ったコースです。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">贅沢コース</h3>
          <p class="card-text">高級食材を使用した贅沢なコースです。大切な日のお食事に是非。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">お手軽コース</h3>
          <p class="card-text">ボリュームを控えめにしたコースです。メインは３種類からお選びいただけます。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">おすすめコース</h3>
          <h6 class="card-subtitle mb-2">-季節の野菜を使用-</h6>
          <p class="card-text">シェフのおすすめコースです。季節ごとに内容は異なります。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">魚介コース</h3>
          <p class="card-text">近くの市場からその日仕入れた魚介類を使ったコースです。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">贅沢コース</h3>
          <p class="card-text">高級食材を使用した贅沢なコースです。大切な日のお食事に是非。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
      <div class="card m-3 p-content-card plan-card">
        <div class="card-body">
          <h3 class="card-title">お手軽コース</h3>
          <p class="card-text">ボリュームを控えめにしたコースです。メインは３種類からお選びいただけます。</p>
          <a class="card-link ml-auto" href="#">詳細</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
// var select = document.querySelector("select[name='keyword']");
// console.log(select);
// var selected_index = select.selectedIndex;
// console.log(selected_index);
// select.options[selected_index].selected = true
</script>
@endsection 