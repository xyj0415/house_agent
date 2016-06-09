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
				<div class="house" onclick="location.href='/for_{{ $house->type }}/{{ $house->id }}'">
					<div class="row">
						<div class="col-md-3">
							<img class="index-image" src="/images/5.jpg" alt="">
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
		<div class="tab-pane fade" id="sold">
			@foreach ($sold as $house)
				<div class="house" onclick="location.href='/for_{{ $house->type }}/{{ $house->id }}'">
					<div class="row">
						<div class="col-md-3">
							<img class="index-image" src="/images/5.jpg" alt="">
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