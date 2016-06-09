@extends('layout')

@section('styles')
	.house:hover
	{
		background-color: #DDD;
		cursor: pointer;
	}
	.index-image
	{
		height: 148px;
		width: 200px;
	}
@stop

@section('content')
	<ul class="nav nav-tabs">
		<li class="active"><a href="#bought" data-toggle="tab">House bought</a></li>
		<li><a href="#sold" data-toggle="tab">House sold</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="bought">
			@foreach ($bought as $house)
				@include('components.single_house')
			@endforeach
		</div>
		<div class="tab-pane fade" id="sold">
			@foreach ($sold as $house)
				@include('components.single_house')
			@endforeach
		</div>
	</div>
@stop