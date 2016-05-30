@extends('layout')

@section('content')

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