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
			@can('see_transaction', $transaction)
				<tr>
					<td>
						@if ($transaction->status == 'buyer_to_agent' || $transaction->status == 'agent to provider')
							Contacting
						@else
							{{ ucfirst($transaction->status) }}
						@endif
					</td>
					<td><a href="/for_{{ $transaction->house->type }}/{{ $transaction->house_id}}">{{ $transaction->house->name }}</a></td>
					<td><a href="/user/{{ $transaction->buyer->id }}">{{ $transaction->buyer->name }}</a></td>
					<td><a href="/user/{{ $transaction->house->provider->id }}">{{ $transaction->house->provider->name }}</a></td>
					<td><a href="/user/{{ $transaction->house->agent->id }}">{{ $transaction->house->agent->name }}</a></td>
					<td>
						@can('contact_provider', $transaction)
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="continue">
								<input class="btn btn-primary" type="submit" value="Contact Provider">
							</form>
						@endcan

						@can('start_transaction', $transaction)
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="continue">
								<input class="btn btn-primary" type="submit" value="Start Transaction">
							</form>
						@endcan

						@can('confirm', $transaction)
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="confirm">
								<input class="btn btn-primary" type="submit" value="Finish Transaction">
							</form>
						@endcan

						@can('cancel', $transaction)
							<form method="POST" action="/transaction/update">
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{ $transaction->id }}">
								<input type="hidden" name="action" value="cancel">
								<input class="btn btn-danger" type="submit" value="Cancel">
							</form>
						@endcan
					</td>
				</tr>
			@endcan
		@endforeach
	</table>

@stop