@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @if(Session::has('error'))) // Laravel 5 (Session('error')   
                    <div class="alert alert-danger">
                        {{ Session::get('success')}} 
                    </div>
                @endif

                <div class="panel-heading">
                    Dashboard   
                    <a href="{{ route('admin.create') }}" class="btn btn-info">New Post</a>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Text</th>
                            <th>Category</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->text }}</td>
                                    <td>{{ $post->category['category'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.show', $post->id) }}" class="btn btn-default">View</a>
                                        <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-default">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>   
                </div>

                <div class="panel-footer text-center">Copyright</div>
            </div>
        </div>
    </div>
</div>
@endsection
