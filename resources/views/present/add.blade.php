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
  <form action="/present/add" method="post">
  <table>
    @csrf
    <tr><th>季節 </th><td><input type="text" name="season"></td></tr>
    <tr><th>種 </th><td><input type="text" name="seed"></td></tr>
    <tr><th>芽 </th><td><input type="text" name="bud"></td></tr>
    <tr><th>成長 </th><td><input type="text" name="grow"></td></tr>
    <tr><th>花 </th><td><input type="text" name="flower"></td></tr>
    <tr><th></th><td><input type="submit" value="追加"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
