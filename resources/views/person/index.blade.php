@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'User.index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
  @if (Auth::check())
      <p>USER: {{$user->name . '(' . $user->email . ')'}}</p>
      @else
      <p>※ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
  @endif
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection