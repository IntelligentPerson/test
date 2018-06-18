<div id='list_error' class="alert alert-danger" style="margin-top: 10px;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
