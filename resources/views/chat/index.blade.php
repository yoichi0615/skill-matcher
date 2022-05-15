@extends('layouts.app')
@section('content')
<chat-component :user-id='@json(\Auth::user()->id)' :user-name='@json(\Auth::user()->name)'></chat-component>
<example-component>
</example-component>
@endsection