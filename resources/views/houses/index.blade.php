@extends('layout')

@section('content')
	<form method="GET" class="form-horizontal">
		<div class="form-group">
			<label for="city" class="col-md-2 control-label">Choose City:</label>
			<div class="col-md-10">
				<select name="city" id="city">
					<option value="shanghai">Shanghai</option>
					<option value="beijing">Beijing</option>
					<option value="guangzhou">Guangzhou</option>
				</select>
			</div>
		</div>
		<input type="submit" value="Search" class="btn btn-primary">
	</form>
	<table class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Price</th>
		</tr>

		@foreach ($houses as $house)
		<tr>
			<td>
				<a href="/for_{{ $type }}/{{ $house->id }}">{{ $house->name }}</a>
			</td>
			<td>
				${{ number_format($house->price) }}
				@if ($type == 'rent')
					/month
				@endif
			</td>
		</tr>
		@endforeach
	</table>
@stop