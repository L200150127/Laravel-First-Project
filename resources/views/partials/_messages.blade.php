@if (Session::has('success'))
	<div class="alert alert-success fade show" role="alert">
	  <strong><i class="fas fa-check"></i> </strong> {{ Session::get('success') }}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger fade show" role="alert"
	id="user-toast">
	  <ul style="margin: 0;padding: 0;list-style: none;">
	  	@foreach ($errors->all() as $error)
	  		<li>
	  			<strong><i class="fas fa-exclamation-circle"></i> </strong> {{ ucwords($error) }}.
	  		</li>
	  	@endforeach
	  </ul>
	</div>
@endif