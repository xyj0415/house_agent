@extends('layout')

@section('content')
	<a href="/for_{{ $type }}/{{ $house->id }}" style="position: absolute;">&lt;&lt;Back</a>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Edit house information</h1>
			<hr>
			<form method="POST" action="/for_{{ $type }}/{{ $house->id }}" enctype="multipart/form-data">
				{{ method_field('PATCH') }}

				@include('houses.edit_form')

				@include('components.error')
			</form>
		</div>
	</div>
@stop