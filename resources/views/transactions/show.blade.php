@extends('layout')

@section('content')

	<h2>Transactions</h2>
	<hr>
	<table class="table table-bordered">
		<tr>
			<th>Status</th>
			<th>House</th>
			<th>Buyer</th>
			<th>Seller</th>
			<th>Agent</th>
			<th>Action</th>
		</tr>
		@foreach ($transactions as $transaction)
			@if (!((\Auth::user()->id == $transaction->house->provider->id) && ($transaction->status == 'buyer_to_agent')))
				<tr>
					<td>
						@if ($transaction->status == 'buyer_to_agent' || $transaction->status == 'agent_to_seller')
							Contacting
						@endif
						@if ($transaction->status == 'transacting')
							Transacting
						@endif
						@if ($transaction->status == 'finished')
							Finished
						@endif
					</td>
					<td><a href="/for_{{ $transaction->house->type }}/{{ $transaction->house_id}}">{{ $transaction->house->name }}</a></td>
					<td><a href="/user/{{ $transaction->buyer->id }}">{{ $transaction->buyer->name }}</a></td>
					<td><a href="/user/{{ $transaction->house->provider->id }}">{{ $transaction->house->provider->name }}</a></td>
					<td><a href="/user/{{ $transaction->house->agent->id }}">{{ $transaction->house->agent->name }}</a></td>
					<td>
						@if (\Auth::user()->id == $transaction->house->agent->id && $transaction->status == 'buyer_to_agent')
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="continue">
								<input class="btn btn-primary" type="submit" value="Contact Provider">
							</form>
						@endif
						@if (\Auth::user()->id == $transaction->house->provider->id && $transaction->status == 'agent_to_seller')
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="continue">
								<input class="btn btn-primary" type="submit" value="Start Transaction">
							</form>
						@endif
						@if (\Auth::user()->id == $transaction->buyer->id || (\Auth::user()->id == $transaction->house->provider->id && $transaction->status != 'buyer_to_agent'))
							<form method="POST" action="/transction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="cancel">
								<input class="btn btn-primary" type="submit" value="Cancel">
							</form>
						@endif
					</td>
				</tr>
			@endif
		@endforeach
	</table>

@stop