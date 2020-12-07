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
    <form action="image_complete" method="post">
        @csrf
        <table border="1">
            <tr>
                <td>画像</td>
                <td><img src="{{ $data['read_temp_path'] }}" width="200" height="130"></td>
            </tr>
            <tr>
                <td>商品名</td>
                <td>{{ $data['product_name'] }}</td>
            </tr>
        </table>
        <input type="submit" name="action" value="送信" />
    </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
