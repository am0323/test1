@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'ユーザ認証')

@section('menubar')
  @parent
  ユーザ認証ページ
@endsection

@section('content')
<p>{{$message}}</p>
  <form action="/person/auth" method="post">
  <table>
    @csrf
    <tr><th>mail: </th><td><input type="text" name="email"></td></tr>
    <tr><th>pass: </th><td><input type="password" name="password"></td></tr>
    <tr><th></th><td><input type="submit" value="send"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
