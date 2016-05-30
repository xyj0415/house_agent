@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Edit the information</h1>

			<hr>

			<form method="POST" action="/for_{{ $type }}/{{ $house->id }}" enctype="multipart/form-data">
				{{ method_field('PATCH') }}

				@include('houses.edit_form')

				@include('components.error')
			</form>

			<a href="/for_{{ $type }}/{{ $house->id }}" type="button" class="btn">Back</a>
		</div>
	</div>
@stop