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
      <tr><th>季節: </th><td>{{$item->season}}</td></tr>
      <tr><th>種: </th><td>{{$item->seed}}</td></tr>
      <tr><th>芽: </th><td>{{$item->bud}}</td></tr>
      <tr><th>成長: </th><td>{{$item->grow}}</td></tr>
      <tr><th>花: </th><td>{{$item->flower}}</td></tr>
   </table>
@endsection

@section('footer')
copyright 2020 東京情報クリエイター工学院専門学校.
@endsection
