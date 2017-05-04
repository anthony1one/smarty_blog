@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">  
                    <a href="{{ route('admin.index') }}" class="btn btn-info">Back</a>
                    <a href="{{ route('admin.edit', $post->id) }}" class="btn btn-info">Edit</a>
                    {!! Form::open(['route' => ['admin.destroy', $post->id], 'method' => 'DELETE']) !!}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger text-center']) }}
                    {!! Form::close() !!}
                </div>

                <div class="panel-body">
                	<p>
                		<b>ID:</b><br>{{ $post->id }}
                	</p>
                    <p>
                		<b>Text:</b><br>{{ $post->text }}
                	</p>
                	<p>
                		<b>Slug:</b><br>{{ $post->slug }}
                	</p>
                	<p>
                		<b>Category:</b><br>{{ $post->category['category'] }}
                	</p>      
                </div>

                <div class="panel-footer text-center">Copyright</div>
            </div>
        </div>
    </div>
</div>
@endsection