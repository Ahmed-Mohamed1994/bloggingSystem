@extends('layouts.master')

@section('title')
    update category
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Edit Category</h3>
            <form action="{{ route('updateCategory' ,['category' => $category->id]) }}" method="post">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name"
                           value="{{  Request::old('name') ? Request::old('name') : isset($category) ? $category->name : '' }}">
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection