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
  <form action="/present/del" method="post">
  <table>
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>季節 </th><td><input type="text" name="season" value="{{$form->season}}"></td></tr>
    <tr><th>種 </th><td><input type="text" name="seed" value="{{$form->seed}}"></td></tr>
    <tr><th>芽 </th><td><input type="text" name="bud" value="{{$form->bud}}"></td></tr>
    <tr><th>成長 </th><td><input type="text" name="grow" value="{{$form->grow}}"></td></tr>
    <tr><th>花 </th><td><input type="text" name="flower" value="{{$form->flower}}"></td></tr>
    <tr><th></th><td><input type="submit" value="削除"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
