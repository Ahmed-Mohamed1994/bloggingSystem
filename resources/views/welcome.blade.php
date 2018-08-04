@extends('layouts.master')

@section('title')
    blogging system
@endsection

@section('style')
    <style>
        .post-article{
            border: 1px solid #bbbaba;
            border-radius: 10px;
            padding: 5px;
            margin: 15px 0;
        }
        .well{
            margin-top: 15px;
        }
    </style>
@endsection

@section('content')

    <!-- Blog Post Content Column -->
    <div class="col-md-8">
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="post-article">
                <!-- Title -->
                <a href="{{ route('showPost',['post' => $post->id]) }}"><h1>{{ $post->title }}</h1></a>
                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->toFormattedDateString() }}
                    at {{ $post->created_at->diffForHumans() }}</p>
                <hr>
                <!-- Preview Image -->
                <img class="img-responsive" src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}">
            </div>
        @endforeach
    @else
        <h1>No Posts Found</h1>
    @endif
    </div>

    <!-- Blog Sidebar Widgets Column -->
    <div class="col-md-4">

        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Filter Blogs</h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled">
                        @foreach($categories as $category)
                            <li><a href="{{ route('categoryPost', ['category' => $category->id]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.row -->
        </div>


    </div>

@endsection
