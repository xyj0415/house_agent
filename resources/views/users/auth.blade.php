@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<h1>Authorize buyers</h1>
			<hr>
			<table class="table table-striped">
				<tr>
					<th>Name</th>
					<th>Action</th>
				</tr>
				@foreach ($users as $user)
					<tr>
						<td><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
						<td>
							<form method="POST" action="/user/buyerauth">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="{{ $user->id }}">
								<button class="btn btn-primary" name="action" value="agree">Authorize</button>
								<button class="btn btn-primary" name="action" value="reject">Reject</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="col-md-6">
			<h1>Authenticate houses</h1>
			<hr>
			<table class="table table-striped">
				<tr>
					<th>Name</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
				@foreach ($houses as $house)
					<tr>
						<td><a href="/for_{{ $house->type }}/{{ $house->id }}">{{ $house->name }}</a></td>
						<td>{{ ucfirst($house->type) }}</td>
						<td>
							<form method="POST" action="/user/houseauth">
								{{ csrf_field() }}
								<input type="hidden" name="house_id" value="{{ $house->id }}">
								<button class="btn btn-primary" name="action" value="agree">Authenticate</button>
								<button class="btn btn-primary" name="action" value="reject">Reject</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@stop