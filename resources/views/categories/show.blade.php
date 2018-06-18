@extends('layout.basic')

@section('title')
    <div class="col-md-12">
        <h1><a href="{{ route('categories.index') }}">Categories</a> / <b>{{ $category->name }}</b></h1>
    </div>
@stop

@section('content')
	<div class="col-md-6">
		<h3>Info</h3>
		<table class="table table-hover">
			<tr>
				<td style="text-transform:uppercase;"><b>name</b></td>
				<td>{{ $category->name }}</td>
			</tr>
			<tr>
				<td style="text-transform:uppercase;"><b>description</b></td>
				<td>{{ $category->description }}</td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<h3>Actions</h3>
		<table class="table table-hover">
			<tr>
				<td style="text-align:center;">
					<a href="{{ route('categories.edit', $category->id) }}">
						<i class="fa fa-edit"></i> Edit
					</a>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;">
					@include('layout.components.delete', ['path' => "/categories/$category->id"])
				</td>
			</tr>
			<tr>
				<td style="text-align:center;">
					<a href="{{ route('posts.create')}}" class="btn btn-primary">
			        	<i class="fa fa-plus"></i>
			        	Add post
			    	</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-12">
		<h3>Posts</h3>
		@if(count($category->posts))
    	<table class="table table-hover">
    		<thead>
    			<tr>
    				<th style="width:35px; text-align:center;"></th>
    				<th>name</th>
    				<th>created_at</th>
    				<th>updated_at</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($category->posts as $post)
    			<tr>
    				<th style="width:35px; text-align:center;">
    					<a href="{{ route('posts.show', $post->id) }}">
    						<i class="fa fa-external-link-square"></i>
    					</a>
    				</th>
    				<td>{{ $post->name }}</td>
    				<td>{{ $post->created_at }}</td>
    				<td>{{ $post->updated_at }}</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    	@else
    	<p>No posts</p>
    	@endif
	</div>
	<div class="col-md-12">
		<h3 class="">Comments</h3>
		@include('comments.form', ['object' => $category])
		<div id="comments_list" style="padding: 15px 5px 5px 5px;">
			@include('comments.loader', ['comments' => $category->attachableComments])
    	</div>
	</div>
@stop
