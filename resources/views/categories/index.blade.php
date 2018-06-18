@extends('layout.basic')

@section('title')
    <div class="col-md-12">
        <h1>Categories</h1>
    </div>
@stop

@section('content')
    <div class="col-md-2">
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-block">
        	<i class="fa fa-plus"></i>
        	Add category
    	</a>
    </div>
    <div class="col-md-10">
		@if(count($categories))
    	<table class="table table-hover">
    		<thead>
    			<tr>
    				<th style="width:35px; text-align:center;"></th>
    				<th>name</th>
    				<th>description</th>
    				<th style="width:45px; text-align:center;">edit</th>
    				<th style="width:45px; text-align:center;">del</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($categories as $category)
    			<tr>
    				<th style="width:35px; text-align:center;">
    					<a href="{{ route('categories.show', $category->id) }}">
    						<i class="fa fa-external-link-square"></i>
    					</a>
    				</th>
    				<td>{{ $category->name }}</td>
    				<td>{{ $category->description }}</td>
    				<td style="width:45px; text-align:center; font-size: 16px;">
    					<a href="{{ route('categories.edit', $category->id) }}">
    						<i class="fa fa-edit"></i>
    					</a>
    				</td>
    				<td style="width:45px; text-align:center;">
                        @include('layout.components.delete', ['path' => "/categories/$category->id"])
    				</td>
    			</tr>
    			@endforeach
    		</tbody>
    	</table>
    	@else
    	<p>No categories</p>
    	@endif
    </div>
@stop
