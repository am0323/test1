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
  <form action="image_confirm" method="post" enctype="multipart/form-data" id="form">
    @csrf
    ファイル：
    <input type="file" name="imagefile" value=""/><br /><br />

    商品名：<br />
    <input type="text" name="product_name" size="50" value="{{ old('name') }}"/><br /><br />

    <input type="submit" name="confirm" id="button" value="確認" />
    </form>
    @foreach($items as $item)
      <td><img src="{{$item->path}}" width="200" height="130"></td><br>
      <td>{{$item->product_name}}</td><br>
    @endforeach
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
