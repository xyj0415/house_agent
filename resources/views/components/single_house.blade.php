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
				<span>{{ ucfirst($house->status) }}</span>
				&nbsp;&nbsp;|&nbsp;&nbsp;
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