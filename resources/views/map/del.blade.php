@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'Delete')

@section('menubar')
  @parent
  削除ページ
@endsection

@section('content')
  <form action="/map/del" method="post">
  <table>
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>写真 </th><td><img src="{{$form->photo}}" width="200" height="130"></td></tr>
    <tr><th>日付 </th><td>{{$form->date}}</td></tr>
    <tr><th>場所 </th><td>{{$form->area}}</td></tr>
    <tr><th></th><td><input type="submit" value="削除"></td></tr>
  </table>
  </form>
  </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
