@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Create new post</div>

                @if (count($errors) > 0)
                    <hr>
                    <ul style="color: red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <hr>
                @endif

                <div class="panel-body">
                    {!! Form::open(['route' => 'admin.store']) !!}

                    	<div class="form-group">
    	                	{{ Form::label('text', 'Text:', ['class' => 'control-label']) }}
	               			{{ Form::text('text', null, ['class' => 'form-control']) }}
                    	</div>

                    	<div class="form-group">
    	                	{{ Form::label('slug', 'Slug:', ['class' => 'control-label']) }}
	               			{{ Form::text('slug', null, ['class' => 'form-control']) }}
                    	</div>

                    	<div class="form-group">
    	                	{{ Form::label('category', 'Category:', ['class' => 'control-label']) }}
	               			{{ Form::select('category', $categories, null, ['class' => 'form-control']) }}
                    	</div>

               			<hr>
               			<div class="text-center">
               				{{ Form::submit('GO', ['class' => 'btn btn-success btn-block']) }}
               			</div>		

                    {!! Form::close() !!}
                </div>

                <div class="panel-footer text-center">Copyright</div>
            </div>
        </div>
    </div>
</div>
@endsection