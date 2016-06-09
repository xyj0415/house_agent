@extends('layout')

@section('content')
	<h2>Profile</h2>
	<hr>
	<table class="table table-bordered table-striped">
		<tr>
			<th>Type</th>
			<td>
				@if ($user->type != 'unauthorizedseller')
					{{ $user->type }}
				@else
					buyer (Waiting for authorization...)
				@endif

				@if (($user->id == $current_user->id) && ($current_user->type == 'buyer'))
					<form method="POST" action="/user/upgraderequest" style="display:inline">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary">Become a Seller</button>
					</form>
				@endif
			</td>
		</tr>
		<tr>
			<th>Name</th>
			<td>{{ $user->name }}</td>
		</tr>
		<tr>
			<th>Email</th>
			<td>
				@if ($user->id != $current_user->id && $current_user->type != 'agent')
					You have no access.
				@else
					{{ $user->email }}
				@endif
			</td>
		</tr>
		<tr>
			<th>Phone</th>
			<td>
				@if ($user->id != $current_user->id && $current_user->type != 'agent')
					You have no access.
				@else
					{{ $user->phone }}
				@endif
			</td>
		</tr>
	</table>

	@if ($user->id == $current_user->id)
		<a class="btn btn-primary" href="/user/{{ $user->id }}/edit">Edit Profile</a>
	@endif

@stop
