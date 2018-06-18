@extends('layout.basic')

@section('title')
	<div class="col-md-12">
		<h1><a href="{{ route('posts.index') }}">Posts</a> / <b>{{ $post->name }}</b></h1>
	</div>
@stop

@section('content')
	<div class="col-md-6">
		<h3>Info</h3>
		<table class="table table-hover">
			<tr>
				<td style="text-transform:uppercase;"><b>category</b></td>
				<td>
					@if($post->category)
					<a href="{{ route('categories.show', $post->category->id) }}">
						{{ $post->category->name }}
					</a>
					@else
					 	<span style="color:#ff3e2c">No category</span>
					@endif
				</td>
			</tr>
			<tr>
				<td style="text-transform:uppercase;"><b>name</b></td>
				<td>{{ $post->name }}</td>
			</tr>
			<tr>
				<td style="text-transform:uppercase;"><b>File</b></td>
				<td>
					@if(count($post->files))
						@foreach($post->files as $file)
						<a href="{{ asset('storage/posts_files/'.$post->name.'_'.$post->id.'/'.$file->name) }}">
							{{ $file->name }}
						</a><br>
						@endforeach
					@else
					 	<span>No files</span>
					@endif
				</td>
			</tr>		
		</table>
		<div class="show_wrap">
			<div class="show_title down">Add new file</div>
		    @if ($errors->any())
		        @include('layout.components.errors', ['errors' => $errors])
		    @endif
			<form class="show_info" action="/posts/add_file" method="POST" enctype="multipart/form-data">
	            <input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input class="form-control" type="hidden" name="post_id" value="{{ $post->id }}">
		        <div class="form-group">
	                <div style="margin-bottom:5px; font-weight:700;">File</div>
	                <label for="add_file" class="add_file_button">
	                    Add file
	                </label>
	                <input id="add_file" type="file" name="file">
		        </div>
	            <div class="clearfix">
	            	<input type="submit" value="Save" class="btn btn-primary pull-left">
	            </div>
			</form>
		</div>
	</div>
	<div class="col-md-6">
		<h3>Actions</h3>
		<table class="table table-hover">
			<tr>
				<td style="text-align:center;">
					<a href="{{ route('posts.edit', $post->id) }}">
						<i class="fa fa-edit"></i> Edit
					</a>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;">
					@include('layout.components.delete', ['path' => "/posts/$post->id"])
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-12">
		<h3>Content</h3>
		<div style="padding: 5px;">
			{!! $post->content !!}
    	</div>
	</div>
	<div class="col-md-12">
		<h3 class="">Comments</h3>
		@include('comments.form', ['object' => $post])
		<div id="comments_list" style="padding: 15px 5px 5px 5px;">
			@include('comments.loader', ['comments' => $post->attachableComments])
    	</div>
	</div>
@stop
