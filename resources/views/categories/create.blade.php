@extends('layout.basic')

@section('title')
	<div class="col-md-12" style="font-size:24px; text-align: center;">
		<p>New category</p>
	</div> 
@stop

@section('content')

    <div class="col-md-12">
    @if ($errors->any())
        @include('layout.components.errors', ['errors' => $errors])
    @endif
		<form action="/categories" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" name="name" value="" >
            </div>
            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
			<input type="submit" value="Save" class="btn btn-primary pull-right">
            <a href="/categories" class="btn btn-default pull-right" style="margin-right:20px">Close</a>
		</form>
    </div>
@stop
