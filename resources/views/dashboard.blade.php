@extends('layouts.master')

@section('title')
    Blogging System
@endsection

@section('content')
<h1 class="text-center">Welcome {{ Auth::user()->name }}</h1>


@endsection