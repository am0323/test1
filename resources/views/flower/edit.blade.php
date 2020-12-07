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
  <form action="/flower/edit" method="post">
  <table>
    @csrf
    <input type="hidden" name="id" value="{{$form->id}}">
    <tr><th>花の名前 </th><td><input type="text" name="name" value="{{$form->name}}"></td></tr>
    <tr><th>花の詳細 </th><td><input type="text" name="detail" value="{{$form->detail}}"></td></tr>
    <tr><th>花言葉 </th><td><input type="text" name="word" value="{{$form->word}}"></td></tr>
    <tr><th></th><td><input type="submit" value="更新"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection
