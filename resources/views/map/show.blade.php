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
      <tr><th>写真: </th><td><img src="{{$item->photo}}" width="200" height="130"></td></tr>
      <tr><th>日付: </th><td>{{$item->date}}</td></tr>
      <tr><th>場所: </th><td>{{$item->area}}</td></tr>
   </table>
@endsection

@section('footer')
copyright 2020 東京情報クリエイター工学院専門学校.
@endsection
