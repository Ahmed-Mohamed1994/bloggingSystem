@extends('layouts.master')

@section('title')
    blogging system
@endsection

@section('style')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row">
        <div class="col-md-12">
            <header><h3>All Posts</h3></header>


            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>category</th>
                    <th>status</th>
                    <th>created_at</th>
                    <th>show</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>@if($post->status) Published @else Unpublished @endif</td>
                        <td>{{ $post->created_at->toDayDateTimeString() }}</td>
                        <th><a href="{{ route('showPost',['post'=>$post->id]) }}" class="btn btn-info">show</a></th>
                        <th><a href="{{ route('editPost',['post'=>$post->id]) }}" class="btn btn-default">update</a></th>
                        <th><a href="{{ route('deletePost',['post'=>$post->id]) }}" class="btn btn-danger">delete</a></th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </section>


@endsection

@section('script')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@endsection