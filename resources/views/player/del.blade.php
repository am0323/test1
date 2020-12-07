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
  <form action="/player/del" method="post">
  <table>
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>名前 </th><td><input type="text" name="name" value="{{$form->name}}"></td></tr>
    <tr><th>生年月日 </th><td><input type="text" name="date" value="{{$form->date}}"></td></tr>
    <tr><th>歩数 </th><td><input type="text" name="step" value="{{$form->step}}"></td></tr>
    <tr><th>ログイン日数 </th><td><input type="text" name="login" value="{{$form->login}}"></td></tr>
    <tr><th>報酬 </th><td><input type="text" name="present" value="{{$form->present}}"></td></tr>
    <tr><th>ランキング </th><td><input type="text" name="rank" value="{{$form->rank}}"></td></tr>
    <tr><th>ポイント </th><td><input type="text" name="point" value="{{$form->point}}"></td></tr>
    <tr><th></th><td><input type="submit" value="削除"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
