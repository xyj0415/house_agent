@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1>
				{{ $house->name }}
				@if ($house->status != 'available')
					<strong style="color:red">(Unavailable!)</strong>
				@endif
			</h1>
			<h3>{{ $house->address }}, {{ $house->district }}, {{ $house->city }}</h3>
			<h2>
				${{ number_format($house->price) }}
				@if($house->type == 'rent')
					/ month
				@endif
			</h2>

			<hr>

			<div class="description" style="white-space:pre">{{ nl2br($house->description) }}</div>

			@if ($user && $user->id == $house->provider_id)
				<a href="/for_{{ $type }}/{{ $house->id }}/edit" type="button" class="btn btn-primary">Edit the information</a>
			@endif
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
			@if ($house->status == 'available' && $user && $user->id != $house->provider_id && $user->type != 'agent')
				<div align="center">
					<form method="POST" action="/transaction">
						{{ csrf_field() }}
						<input type="hidden" name="house_id" value="{{ $house->id }}">
						<input type="hidden" name="buyer_id" value="{{ $user->id }}">	
						<input type="hidden" name="status" value="buyer_to_agent">
						<button type="submit" class="btn btn-primary">Contact</button>
					</form>
				</div>
			@endif
		</div>
	</div>
@stop