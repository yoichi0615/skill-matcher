@extends('layouts.app')
@section('content')

<div>
  これはユーザー（投稿の詳細ページです。）
</div>
@auth
  @if (\Auth::user()->id === $post->user_id)
      <a href="{{ route('post.edit', ['id' => $post->id] )}}">投稿を編集</a>
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
            <a href="{{ route('tags.show', ['name' => $tag->name]) }}" class="border p-1 mr-1 mt-1 text-muted">
              {{$tag->hash_tag}}
            </a>
          @endforeach
        </span>
        <h6 class="">提供タイトル</h1>
        <h1 class="item-header-title">{{ $post->summary }}</h1>
        <h6 class="item-header-want">求めるスキル</h3>
        <p style="font-size: 30px;">{{ $post->want }}</p>
        <span>所在地（必要であれば）</span>
      </div>
      <div class="item-image">
        <a href="#" onclick="openImage();">
          <img src="{{ Storage::url($post->image_path) }}" alt="仮置きイメージ">
        </a>
      </div>
      <div class="item-description">
        <figure>
          <ul style="list-style: none;">
            <li style="border-bottom: 1px solid gray;">
              <span style="font-size:12px;">発行日</span>
              <span style="font-size:15px;">{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}（@if($now->diffInDays($post->created_at) === 0)今日@else {{$now->diffInDays($post->created_at)}}日前 @endif）</span>
              <span style="font-size:12px;">最終更新</span>
              <span style="font-size:15px;">{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d') }}（@if($now->diffInDays($post->created_at) === 0)今日@else {{$now->diffInDays($post->created_at)}}日前 @endif）</span>
            </li>
            <li style="border-bottom: 1px solid gray;">
              <div>タグを挿入（仮置き）</div>
            </li>
          </ul>
        </figure>
      </div>
    </div>
  </div>
</section>
@auth
<chat-button-component :login-user-id="{{\Auth::user()->id}}" :user-id="{{ $id }}" :has-room="@if(!\Auth::user()->hasRoom(\Auth::user()->hasRoom(\Auth::user()->id))) 0 @else 1 @endif"></chat-button-component>
@endauth
{{-- <a href="{{route('chat.index')}}"><div>メッセージを送る</div></a> --}}
@endsection