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
  <td><a href="/present/add">新規登録</a></td>
  <tr>
    <th>ID</a></th>
    <th>季節</a></th>
    <th>種</a></th>
    <th>芽</a></th>
    <th>成長</a></th>
    <th>花</a></th>
  </tr>
  @foreach($items as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->season}}</td>
      <td>{{$item->seed}}</td>
      <td>{{$item->bud}}</td>
      <td>{{$item->grow}}</td>
      <td>{{$item->flower}}</td>
      <td><a href="/present/show?id={{$item->id}}">詳細</a></td>
      <td><a href="/present/edit?id={{$item->id}}">更新</a></td>
      <td><a href="/present/del?id={{$item->id}}">削除</a></td>
    </tr>
  @endforeach
  </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
