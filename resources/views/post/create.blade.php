@extends('layouts.master')

@section('title')
    create new post
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-12">
            <h3>Create New Post</h3>
            <form action="{{ route('storePost') }}" method="post" enctype="multipart/form-data">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Post Title</label>
                    <input class="form-control" type="text" name="title" id="title" value="{{ Request::old('title') }}">
                </div>

                <div class="form-group {{ $errors->has('post_category') ? 'has-error' : '' }}">
                    <label for="post_category">Select Category:</label>
                    <select class="form-control" name="post_category" id="post_category">
                        <option value="" selected>Select Post Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Post Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                <div class="form-group">
                    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
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