<div class="show_wrap">
	<div class="show_title down">Add comment</div>
    <div id="error_comment"></div>
	<form id="comment" class="show_info" action="/comment" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="attachable_id" value="{{ $object->id }}">
		<input type="hidden" name="attachable_type" value="{{ get_class($object) }}">
        <div class="form-group">
            <label class="control-label">Author</label>
            <input class="form-control first_uppercase_letter" type="text" name="author">
        </div>
        <div class="form-group">
            <label class="control-label">Comment</label>
            <textarea class="form-control" name="comment"></textarea>
        </div>
        <div class="clearfix">
        	<input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
	</form>
</div>
