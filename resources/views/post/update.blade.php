@extends('layouts.master')

@section('title')
    Edit Post
@endsection

@section('style')
    <style>
        .update-form{
            padding-bottom: 25px;
        }
    </style>
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row update-form">
        <div class="col-md-12">
            <h3>Edit Post</h3>
            <form action="{{ route('updatePost',['post' => $post->id]) }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Post Title</label>
                    <input class="form-control" type="text" name="title" id="title"
                           value="{{  Request::old('title') ? Request::old('title') : isset($post) ? $post->title : '' }}">
                </div>

                <div class="form-group {{ $errors->has('post_category') ? 'has-error' : '' }}">
                    <label for="post_category">Select Category:</label>
                    <select class="form-control" name="post_category" id="post_category">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id == $post->category_id)selected @endif>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{ $errors->has('post_status') ? 'has-error' : '' }}">
                    <label for="post_status">Select Status:</label>
                    <select class="form-control" name="post_status" id="post_status">
                            <option value="0" @if($post->status == 0)selected @endif>Unpublished</option>
                            <option value="1" @if($post->status == 1)selected @endif>Published</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Post Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <div class="form-group">
                    <textarea name="editor1" id="editor1" rows="10" cols="80">{{ $post->body }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
    </script>
@endsection