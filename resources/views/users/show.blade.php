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
				@can('see_profile', $user)
					{{ $user->email }}
				@else
					You have no access.
				@endcan
			</td>
		</tr>
		<tr>
			<th>Phone</th>
			<td>
				@can('see_profile', $user)
					{{ $user->phone }}
				@else
					You have no access.
				@endcan
			</td>
		</tr>
	</table>

	@can('edit_profile', $user)
		<a class="btn btn-primary" href="/user/{{ $user->id }}/edit">Edit Profile</a>
	@endcan

@stop
