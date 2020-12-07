@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'show')

@section('menubar')
  @parent
  詳細ページ
@endsection

@section('content')
   <table>
      <tr><th>ID: </th><td>{{$item->id}}</td></tr>
      <tr><th>名前: </th><td>{{$item->name}}</td></tr>
      <tr><th>生年月日: </th><td>{{$item->date}}</td></tr>
      <tr><th>歩数: </th><td>{{$item->step}}</td></tr>
      <tr><th>ログイン日数: </th><td>{{$item->login}}</td></tr>
      <tr><th>報酬: </th><td>{{$item->present}}</td></tr>
      <tr><th>ランキング: </th><td>{{$item->rank}}</td></tr>
      <tr><th>ポイント: </th><td>{{$item->point}}</td></tr>
   </table>
@endsection

@section('footer')
copyright 2020 東京情報クリエイター工学院専門学校.
@endsection
