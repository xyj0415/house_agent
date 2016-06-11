@extends('layout')

@section('scripts')
	<script src="/js/district_select.js"></script>
@stop

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
		<div class="col-md-3" style="padding: 10px; border:dotted; border-width:1px; border-radius: 5px;">
			<form method="GET">
				<div class="form-group">
					<label for="name" class="control-label">Name:</label>
					<input type="text" class="form-control" name="name">
				</div>
				<div class="form-group">
					<label for="city" class="control-label">Choose City:</label>
					<select name="city" class="form-control" id="city">
						<option value=""></option>
					</select>
				</div>
				<div class="form-group">
					<label for="district" class="control-label">Choose District:</label>
					<select name="district" class="form-control" id="district">
						<option value=""></option>
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
				@include('components.single_house')
			@endforeach
		</div>
	</div>
@stop