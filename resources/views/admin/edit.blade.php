@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

            	{!! Form::model($post, ['route' => ['admin.update', $post->id], 'method' => 'PUT']) !!}

	                <div class="panel-heading">
                        @if (count($errors) > 0)
                            <hr>
                            <ul style="color: red;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <hr>
                        @endif

	                    <a href="{{ route('admin.show', $post->id) }}" class="btn btn-info">Undo</a>
	                    {{ Form::submit('Save', ['class' => 'btn btn-success']) }}
	                </div>

	                <div class="panel-body">
	                    <div class="form-group">
    	                	{{ Form::label('text', 'Text:', ['class' => 'control-label']) }}
	               			{{ Form::text('text', null, ['class' => 'form-control']) }}
                    	</div>

                    	<div class="form-group">
    	                	{{ Form::label('slug', 'Slug:', ['class' => 'control-label']) }}
	               			{{ Form::text('slug', null, ['class' => 'form-control']) }}
                    	</div>

                    	<div class="form-group">
    	                	{{ Form::label('category_id', 'Category:', ['class' => 'control-label']) }}
	               			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
                    	</div>
	                </div>

                {!! Form::close() !!}

                <div class="panel-footer text-center">Copyright</div>
            </div>
        </div>
    </div>
</div>
@endsection