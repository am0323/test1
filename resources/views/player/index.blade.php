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
  <select onChange="location.href=value;">
    <option value="/player?sort=id">ID</a></th>
    <option value="/player?sort=name">名前</a></th>
    <option value="/player?sort=date">生年月日</a></th>
    <option value="/player?sort=step">歩数</a></th>
    <option value="/player?sort=login">ログイン日数</a></th>
    <option value="/player?sort=present">報酬</a></th>
    <option value="/player?sort=rank">ランキング</a></th>
    <option value="/player?sort=point">ポイント</a>
  </select>
  <td><a href="/player/add">新規登録</a></td>
  <tr>
    <th><a href="/player?sort=id">ID</a></th>
    <th><a href="/player?sort=name">名前</a></th>
    <th><a href="/player?sort=date">生年月日</a></th>
    <th><a href="/player?sort=step">歩数</a></th>
    <th><a href="/player?sort=login">ログイン日数</a></th>
    <th><a href="/player?sort=present">報酬</a></th>
    <th><a href="/player?sort=rank">ランキング</a></th>
    <th><a href="/player?sort=point">ポイント</a></th>
  </tr>
  @foreach($items as $item)
    <tr>
      <td>{{$item->id}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->date}}</td>
      <td>{{$item->step}}</td>
      <td>{{$item->login}}</td>
      <td>{{$item->present}}</td>
      <td>{{$item->rank}}</td>
      <td>{{$item->point}}</td>
      <td><a href="/player/show?id={{$item->id}}">詳細</a></td>
      <td><a href="/player/edit?id={{$item->id}}">更新</a></td>
      <td><a href="/player/del?id={{$item->id}}">削除</a></td>
    </tr>
  @endforeach
  </table>
  {{$items->appends(['sort'=>$sort])->links()}}
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
