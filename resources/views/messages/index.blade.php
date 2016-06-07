@extends('layout')

@section('styles')
	.message:hover
	{
		background-color:#DDD;
	}
	a
	{
		color:black;
	}
@stop

@inject($user, 'App\User')

@section('content')
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#new" data-toggle="tab">New Message</a></li>
				<li class="active"><a href="#check" data-toggle="tab">
					@if ($message_unread_num == 0)
						Check Messages
					@else
						<strong>Check Messages({{ $message_unread_num }})</strong>
					@endif
				</a></li>
				<li><a href="#notification" data-toggle="tab">
					@if ($notification_unread_num == 0)
						Notifications
					@else
						<strong>Notifications({{ $notification_unread_num }})</strong>
					@endif
				</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<div class="tab-content">
				<div class="tab-pane" id="new">
					<form class="form-horizontal" method="POST" action="/message">
						@include('messages.send_form')
					</form>
				</div>
				<div class="tab-pane in active" id="check">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#inbox" data-toggle="tab">Inbox</a></li>
						<li><a href="#outbox" data-toggle="tab">Outbox</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane in active" id="inbox">
							<table class="table">
								<tr>
									<th>From</th>
									<th>Subject</th>
									<th>Time</th>
								</tr>
								@foreach ($received as $message)
									@if ($message->sender_id != 0)
										<tr class="message">
											@if ($message->hasread == 0)
												<td class="col-md-2"><strong><a href="/user/{{ $user::find($message->sender_id)->id }}">{{ $user::find($message->sender_id)->name }}</a></strong></td>
												<td class="col-md-7"><strong><a href="/message/{{ $message->id }}">{{ $message->subject }}</a></strong></td>
												<td class="col-md-3"><strong>{{ $message->created_at }}</strong></td>
											@else
												<td class="col-md-2"><a href="/user/{{ $user::find($message->sender_id)->id }}">{{ $user::find($message->sender_id)->name }}</a></td>
												<td class="col-md-7"><a href="/message/{{ $message->id }}">{{ $message->subject }}</a></td>
												<td class="col-md-3">{{ $message->created_at }}</td>
											@endif
										</tr>
									@endif
								@endforeach
							</table>
						</div>
						<div class="tab-pane" id="outbox">
							bbb
						</div>
					</div>
				</div>
				<div class="tab-pane" id="notification">
					<table class="table">
						<tr>
							<th>Subject</th>
							<th>Time</th>
						</tr>
						@foreach ($received as $message)
							@if ($message->sender_id == 0)
								<tr class="message">
									@if ($message->hasread == 0)
										<td class="col-md-3"><strong><a href="/message/{{ $message->id }}">{{ $message->subject }}</strong></a></td>
										<td class="col-md-9"><strong>{{ $message->created_at }}</strong></td>
									@else
										<td class="col-md-3"><a href="/message/{{ $message->id }}">{{ $message->subject }}</a></td>
										<td class="col-md-9">{{ $message->created_at }}</td>
									@endif
								</tr>
							@endif
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@stop