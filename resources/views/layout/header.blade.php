<div class="container">
    <div class="row">
        <div class="col-lg-12">
		    <p>Cliens:</p>
			@foreach($clients_in_header as $client)
				{{$client}}<br>
			@endforeach
        </div>
    </div>
</div>
