@extends('layout')

@section('styles')
	.gray-text
	{
		color: #999;
	}

	.big_image
	{
		height:500px;
		width:800px;
	}
	.thumbnail
	{
		height: 100px;
		width: 100px;
		display: inline-block;
	}
	.thumbnail:hover
	{
		cursor: pointer;
	}
@stop

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1>
				{{ $house->name }} <small>({{ $house->status }})</small>
			</h1>
			@if ($images->count() != 0)
				<hr>
				<img class="big_image" id="image_holder" src="{{ $images->first()->path}}">
				@foreach ($images as $image)
					<img class="thumbnail" src="{{ $image->path }}" onclick="show(this)">
				@endforeach
			@endif
			<hr>
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-2">
							<p class="gray-text">Price:</p>
						</div>
						<div class="col-md-10">
							<p>
								${{ number_format($house->price) }}
								@if($house->type == 'rent')
									/ month
								@endif
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="gray-text">Price/m<sup>2</sup>:</p>
						</div>
						<div class="col-md-10">
							<p>
								${{ number_format(round($house->price / $house->area)) }}/m<sup>2</sup>
								@if($house->type == 'rent')
									/ month
								@endif
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-2">
							<p class="gray-text">Area:</p>
						</div>
						<div class="col-md-10">
							<p>{{ $house->area }}m<sup>2</sup></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<p class="gray-text">Address:</p>
						</div>
						<div class="col-md-10">
							<p>{{ $house->address }}</p>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="description" style="white-space:pre">{{ nl2br($house->description) }}</div>
			@can('edit', $house)
				<a href="/for_{{ $type }}/{{ $house->id }}/edit" type="button" class="btn btn-primary">Edit information</a>

				<form class="dropzone" method="POST" action="/for_{{ $type }}/{{ $house->id }}/addphoto">
					{{ csrf_field() }}
				</form>
			@endcan

			@can('delete', $house)
				<form method="POST" action="/for_{{ $type }}/{{ $house->id }}">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger">Remove house</button>
				</form>
			@endcan
		</div>
		<div class="col-md-3">
			<h3>Agent information</h3>
			<table class="table table-bordered">
				<tr>
					<th>Name</th>
					<td>{{ $house->agent->name }}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{ $house->agent->email }}</td>
				</tr>
				<tr>
					<th>Phone</th>
					<td>{{ $house->agent->phone }}</td>
				</tr>
			</table>
			@can('contact', $house)
				<div align="center">
					<form method="POST" action="/transaction">
						{{ csrf_field() }}
						<input type="hidden" name="house_id" value="{{ $house->id }}">
						<input type="hidden" name="buyer_id" value="{{ $user->id }}">
						<input type="hidden" name="status" value="buyer_to_agent">
						<button type="submit" class="btn btn-primary">Contact</button>
					</form>
				</div>
			@else
				@if ($house->status != 'available')
					<div align="center">
						<button class="btn disabled">House Unavailable</button>
					</div>
				@endif
			@endcan
		</div>
	</div>
@stop

@section('scripts')
	function show(image)
	{
		var path = image.getAttribute('src');
		document.getElementById("image_holder").setAttribute("src", path);
	}
@stop