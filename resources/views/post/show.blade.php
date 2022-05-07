@extends('layouts.app')
@section('content')
<div>
  これはユーザー（投稿の詳細ページです。）
</div>
@auth
  @if (\Auth::user()->id === $post->user_id)
      <a href="{{ route('post.edit' )}}">投稿を編集</a>
  @endif
@endauth
@php
    $now = new \Carbon\Carbon();
@endphp

<section>
  <div class="container">
    <div class="col-md-8 item-frame">
      <div class="item-heder">
        <span>
          @foreach ($post->tags as $tag)
            {{$tag->hash_tag}}
          @endforeach
        </span>
        <h1 class="item-header-title">{{ $post->summary }}</h1>
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
              <span style="font-size:12px;">発行日</span>
              <span style="font-size:15px;">{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }} ({{$now->diffInDays($post->created_at)}}日前)</span>
              <span style="font-size:12px;">最終更新</span>
              <span style="font-size:15px;">{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d') }} ({{$now->diffInDays($post->created_at)}}日前)</span>
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