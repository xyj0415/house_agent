@extends('layout')

@section('styles')
	.house
	{
		border-top-style: dotted;
		border-bottom-style: dotted;
		border-width: 1px;
		height: 150px;
	}
	.house:hover
	{
		background-color:#DDD;
		cursor: pointer;
	}

	.index-image
	{
		height: 148px;
		width: 200px;
	}
@stop

@section('content')
	<div class="row">
		<div class="col-md-3">
			<form method="GET">
				<div class="form-group">
					<label for="name" class="control-label">Name:</label>
					<input type="text" class="form-control" name="name">
				</div>
				<div class="form-group">
					<label for="city" class="control-label">Choose City:</label>
					<select name="city" class="form-control" id="city">
						<option value=""></option>
						<option value="shanghai">Shanghai</option>
						<option value="beijing">Beijing</option>
						<option value="guangzhou">Guangzhou</option>
					</select>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col col-md-2">
							<label for="area" class="control-label" style="line-height:28px">Area:</label>
						</div>
						<div class="col col-md-5">
							<input type="text" name="minarea" class="form-control">
						</div>
						<div class="col col-md-5">
							<span style="position:absolute;left:-4px;top:1px;font-size:20px">-</span>
							<input type="text" name="maxarea" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col col-md-2">
							<label for="area" class="control-label" style="line-height:28px">Price:</label>
						</div>
						<div class="col col-md-5">
							<input type="text" name="minprice" class="form-control">
						</div>
						<div class="col col-md-5">
							<span style="position:absolute;left:-4px;top:1px;font-size:20px">-</span>
							<input type="text" name="maxprice" class="form-control">
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="radio" name="selection" value="available" checked="checked"> Only available
					<input type="radio" name="selection" value="all"> Show all
				</div>
				<input type="submit" value="Search" class="btn btn-default">
			</form>
		</div>
		<div class="col-md-9">
				@if (sizeof($houses) == 0)
					<h2>No matches.</h2>
				@endif
				@foreach ($houses as $house)
				<div class="house" onclick="location.href='/for_{{ $house->type }}/{{ $house->id }}'">
					<div class="row">
						<div class="col-md-3">
							@if (\App\Image::where('house_id', $house->id)->first() != null)
								<img class="index-image" src="{{ \App\Image::where('house_id', $house->id)->first()->path}}" alt="">
							@else
								<h3 class="text-center" style="padding: 35px;color:#ccc">No Image</h3>
							@endif
						</div>
						<div class="col-md-6">
							<h3>{{ $house->name }}</h3>
							<p>
								<span>{{ $house->area }}m<sup>2</sup></span>
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<span>built in 2009</span>
								@if ($house->type == 'sell')
									&nbsp;&nbsp;|&nbsp;&nbsp;<span>${{ round($house->price / $house->area) }}/m<sup>2</sup></span>
								@endif
							</p>
						</div>
						<div class="col-md-3">
							<h3 style="color:DarkOrange;">
								${{ number_format($house->price) }}
								@if ($house->type == 'rent')
									/month
								@endif
							</h3>
						</div>
					</div>
				</div>
				@endforeach
		</div>
	</div>
@stop