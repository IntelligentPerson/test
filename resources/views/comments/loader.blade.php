@foreach($comments as $comment)
	<div class="comment" style="background:#f5f5f5; padding:10px 10px 15px 10px; margin-bottom:10px">
		<div class="comment-container">
			<div class="comment-header" style="margin-bottom:10px;">
				<p style="margin: 0;">Author: <b>{{ $comment->author }}</b></p>
				<small style="color:#999;">{{ $comment->created_at }}</small>
			</div>
			<div class="comment-body">
				{{ $comment->comment }}
			</div>
		</div>
	</div>
@endforeach
