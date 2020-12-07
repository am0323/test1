@extends('layouts.helloapp')
<style>
  .pagination { font-size:10px; }
  .pagination li { display:inline-block }
  tr th a:link { color:white; }
  tr th a:visited { color:white; }
  tr th a:hover { color:white; }
  tr th a:active { color:white; }
</style>
@section('title', 'Edit')

@section('menubar')
  @parent
  更新ページ
@endsection

@section('content')
  <form action="/map/edit" method="post">
  <table>
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>写真 </th><td><input type="file" name="photo" value="{{$form->photo}}"></td></tr>
    <tr><th>日付 </th><td><input type="text" name="date" value="{{$form->date}}"></td></tr>
    <tr><th>場所 </th><td><input type="text" name="area" value="{{$form->area}}"></td></tr>
    <tr><th></th><td><input type="submit" value="更新"></td></tr>
  </table>
  </form>
  </table>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
