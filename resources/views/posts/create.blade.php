@extends('layout.basic')

@section('title')
	<div class="col-md-12" style="font-size:24px; text-align: center;">
		<p>New post</p>
	</div> 
@stop

@section('content')

    <div class="col-md-12">
    @if ($errors->any())
        @include('layout.components.errors', ['errors' => $errors])
    @endif
		<form action="/posts" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label">Category</label>
                <select name="category_id">
                    <option value="" {{ old('category_id') == null ? 'selected' : '' }}>
                        No category
                    </option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Name</label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <div style="margin-bottom:5px; font-weight:700;">File</div>
                <label for="add_file" class="add_file_button">
                    Add file
                </label>
                <input id="add_file" type="file" name="file">
            </div>
            <div class="form-group">
                <label class="control-label">Content</label>
                <textarea class="tinymce" name="content">{{ old('content') }}</textarea>
            </div>
			<input type="submit" value="Save" class="btn btn-primary pull-right">
            <a href="/posts" class="btn btn-default pull-right" style="margin-right:20px">Close</a>
		</form>
    </div>
@stop
