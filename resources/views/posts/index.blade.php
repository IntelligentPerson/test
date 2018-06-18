@extends('layout.basic')

@section('title')
    <div class="col-md-12">
        <h1>Posts</h1>
    </div>
@stop

@section('content')
    <div class="col-md-2">
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-block">
        	<i class="fa fa-plus"></i>
        	Add post
    	</a>
    </div>
    <div class="col-md-10">
		@if(count($posts))
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width:35px; text-align:center;"></th>
                        <th>name</th>
                        <th>category</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th style="width:45px; text-align:center;">edit</th>
                        <th style="width:45px; text-align:center;">del</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th style="width:35px; text-align:center;">
                            <a href="{{ route('posts.show', $post->id) }}">
                                <i class="fa fa-external-link-square"></i>
                            </a>
                        </th>
                        <td>{{ $post->name }}</td>
                        <td>                            
                            @if($post->category)
                                {{ $post->category->name }}
                            @else
                                <span style="color:#ff3e2c">no category</span>
                            @endif
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td>{{ $post->updated_at }}</td>
                        <td style="width:45px; text-align:center; font-size: 16px;">
                            <a href="{{ route('posts.edit', $post->id) }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td style="width:45px; text-align:center;">
                            @include('layout.components.delete', ['path' => "/posts/$post->id"])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No posts</p>
            @endif
    </div>
@stop
