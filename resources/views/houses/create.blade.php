@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>{{ ucfirst($type) }}ing Your House?</h1>
			
			<hr>

			<form class="form-horizontal" method="POST" action="/for_{{ $type }}" enctype="multipart/form-data">
				
				@include('houses.create_form')

			</form>

			@include('components.error')
		</div>
	</div>
@stop