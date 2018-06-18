<form action="{{ $path }}" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="del" class="btn btn-danger" style="padding: 0px 5px;">
</form>
