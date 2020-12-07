@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'index')

@section('menubar')
  @parent
  インデックスページ
@endsection

@section('content')
    <form action="/map" method="post">
      @csrf
      <table>
        <tr><th>写真 </th><td><input type="file" name="photo" value=""></td></tr>
        <tr><th>日付 </th><td><input type="text" name="date"></td></tr>
        <tr><th>場所 </th><td><input type="text" name="area"></td></tr>
        <tr><th></th><td><input type="submit" name="action" id="button" value="追加" /></td></tr>
      </table>
    </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
