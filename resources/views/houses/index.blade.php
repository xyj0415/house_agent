@extends('layout')

@section('styles')
	.number-input
	{
		width: 30px;
	}
@stop

@section('content')
	<div class="row">
		<div class="col-md-3">
			<form method="GET">
				<div class="form-group">
					<label for="city" class="control-label">Choose City:</label>
					<select name="city" id="city">
						<option value="shanghai">Shanghai</option>
						<option value="beijing">Beijing</option>
						<option value="guangzhou">Guangzhou</option>
					</select>
				</div>
				<div class="form-group">
					<label for="area" class="control-label">Area:</label>
					<input type="text" name="minarea" class="number-input">
					<span>-</span>
					<input type="text" name="maxarea" class="number-input">
				</div>
				<input type="submit" value="Search" class="btn btn-primary">
			</form>
		</div>
		<div class="col-md-9">
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
		</div>
	</div>
@stop