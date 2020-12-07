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
      <tr><th>花言葉: </th><td>{{$item->word}}</td></tr>
   </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
