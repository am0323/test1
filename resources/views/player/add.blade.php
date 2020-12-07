@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'Add')

@section('menubar')
  @parent
  新規作成ページ
@endsection

@section('content')
  <form action="/player/add" method="post">
  <table>
    @csrf
    <tr><th>名前 </th><td><input type="text" name="name"></td></tr>
    <tr><th>生年月日 </th><td><input type="text" name="date"></td></tr>
    <tr><th>歩数 </th><td><input type="text" name="step"></td></tr>
    <tr><th>ログイン日数 </th><td><input type="text" name="login"></td></tr>
    <tr><th></th><td><input type="submit" value="追加"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
