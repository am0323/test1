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
  <table>
  <tr>
    <th>ID</a></th>
    <th>名前</a></th>
    <th>花言葉</a></th>
  </tr>
  @foreach($items as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->word}}</td>
      <td><a href="/flower/show?id={{$item->id}}">詳細</a></td>
      <td><a href="/flower/edit?id={{$item->id}}">更新</a></td>
    </tr>
  @endforeach
  </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
