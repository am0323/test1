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
    <tr><th>写真: </th><td><img src="{{$items->path}}" width="200" height="130"></td></tr>
    <tr><th>商品名</th><td>{{ $items->product_name }}</td></tr>
  </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
