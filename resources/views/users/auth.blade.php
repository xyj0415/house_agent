@extends('layout')

@section('content')
	<ul class="nav nav-tabs">
		<li class="active"><a href="#buyer" data-toggle="tab">Authorize users</a></li>
		<li><a href="#house" data-toggle="tab">Authenticate houses</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade in active" id="buyer">
			<table class="table table-striped">
				<tr>
					<th>Name</th>
					<th>Action</th>
				</tr>
				@foreach ($users as $user)
					<tr>
						<td><a href="/user/{{ $user->id }}">{{ $user->name }}</a></td>
						<td>
							<form method="POST" action="/user/auth">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="{{ $user->id }}">
								<input type="hidden" name="action" value="user">
								<button class="btn btn-primary" name="action" value="agree">Authorize</button>
								<button class="btn btn-primary" name="action" value="reject">Reject</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
		<div class="tab-pane fade" id="house">
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
							<form method="POST" action="/user/auth">
								{{ csrf_field() }}
								<input type="hidden" name="house_id" value="{{ $house->id }}">
								<input type="hidden" name="action" value="house">
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