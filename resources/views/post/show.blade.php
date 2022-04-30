@extends('layouts.app')
@section('content')
<div>
  これはユーザー（投稿の詳細ページです。）
</div>
@if (\Auth::user()->id === $post->user_id)
    <a href="{{ route('post.edit' )}}">投稿を編集</a>
@endif

<section>
  <div class="container">
    <div class="col-md-8 item-frame">
      <div class="item-heder">
        <span>これが所属する分類（お金、英語、プログラミング、etc...）（仮置き）</span>
        <h1 class="item-header-title">募集タイトル</h1>
        <h3 class="item-header-want">求めるスキル</h3>
        <span>所在地（必要であれば）</span>
      </div>
      <div class="item-image">
        <a href="#" onclick="openImage();">
          <img src="" alt="仮置きイメージ">
        </a>
      </div>
      <div class="item-description">
        <figure>
          <ul>
            <li>
              <span style="font-size:12px;">発行日（仮置き）</span>
              <span style="font-size:15px;">4ヶ月前（仮置き）</span>
              <span style="font-size:12px;">最終更新（仮置き）</span>
              <span style="font-size:15px;">2ヶ月前（仮置き）</span>
            </li>
            <li>
              <div>タグを挿入（仮置き）</div>
            </li>
          </ul>
        </figure>
      </div>
    </div>
  </div>
</section>
@endsection 