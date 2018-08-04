@extends('layouts.master')

@section('title')
    blogging system
@endsection

@section('style')
    <style>
        .right{
            float: right;
        }
        .well{
            margin-top: 15px;
        }
    </style>
@endsection

@section('content')
    @include('includes.message-block')

<!-- Blog Post Content Column -->
<div class="col-md-8">

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <strong>{{ $post->user->name }}</strong> -
        <a href="{{ route('categoryPost', ['category' => $post->category_id]) }}">{{ $post->category->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->toFormattedDateString() }}
        at {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ Storage::url($post->image) }}" alt="">

    <hr>

   {!! $post->body !!}
    <hr>

@if(count($comments) > 0)
    <!-- Blog Comments -->
        <div class="comments">
            <ul class="list-group">
                @foreach($comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->created_at->diffForHumans() }} : </strong>
                        {{ $comment->body }}
                        @if(Auth::check())
                            <a href="{{ route('deleteComment', ['comment' => $comment->id]) }}" class="right">delete</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <hr>
@endif

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form method="post" action="{{ route('storeComment', ['post' => $post->id ]) }}">
            <div class="form-group">
                <textarea class="form-control" rows="3" name="body" id="body"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
            {{ csrf_field() }}
        </form>
    </div>

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
