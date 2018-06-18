@extends('layout.basic')

@section('title')
	<div class="col-md-12" style="font-size:24px; text-align: center;">
		<p>Edit category</p>
	</div> 
@stop

@section('content')

    <div class="col-md-12">
    @if ($errors->any())
        @include('layout.components.errors', ['errors' => $errors])
    @endif
		<form action="/categories/{{ $category->id }}" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ $category->name }}">
            </div>
            <div class="form-group">
                <label class="control-label">Description</label>
                <textarea class="form-control" name="description">{{ $errors->any() ? old('description') : $category->description }}</textarea>
            </div>
			<input type="submit" value="Save" class="btn btn-primary pull-right">
            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-default pull-right" style="margin-right:20px">Close</a>
		</form>
    </div>
@stop
