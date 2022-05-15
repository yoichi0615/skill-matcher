@extends('layouts.app')
@section('content')
チャットルームインデックスページ
  @if(isset($room))
  <chat-list-component :login-user-id="{{ \Auth::user()->id }}" :target-room-id="{{$room->roomId}}"></chat-list-component>
  @else
  <chat-list-component :login-user-id="{{ \Auth::user()->id }}"></chat-list-component>
  @endif
@endsection