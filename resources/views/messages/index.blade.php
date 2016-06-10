@extends('layout')

@section('styles')
	.message:hover
	{
		background-color: #DDD;
		cursor: pointer;
	}
	.unread
	{
		font-weight: bold;
	}
	a
	{
		color:black;
	}
@stop

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
				<div class="tab-pane fade" id="new">
					<form class="form-horizontal" method="POST" action="/message">
						@include('messages.send_form')
					</form>
				</div>
				<div class="tab-pane fade in active" id="check">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#inbox" data-toggle="tab">Inbox</a></li>
						<li><a href="#outbox" data-toggle="tab">Outbox</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade in active" id="inbox">
							<table class="table">
								<tr>
									<th>From</th>
									<th>Subject</th>
									<th>Time</th>
								</tr>
								@foreach ($received as $message)
									@if ($message->sender_id != 0)
										<tr class="message
											@if ($message->hasread == 0)
												unread
											@endif" onclick="location.href='/message/{{ $message->id }}'">
											<td class="col-md-2">{{ $message->sender->name }}</td>
											<td class="col-md-7">{{ $message->subject }}</td>
											<td class="col-md-3">{{ $message->created_at }}</td>
										</tr>
									@endif
								@endforeach
							</table>
						</div>
						<div class="tab-pane fade" id="outbox">
							<table class="table">
								<tr>
									<th>To</th>
									<th>Subject</th>
									<th>Time</th>
								</tr>
								@foreach ($sent as $message)
									<tr class="message" onclick="location.href='/message/{{ $message->id }}'">
										<td class="col-md-2">{{ $message->receiver->name }}</td>
										<td class="col-md-7">{{ $message->subject }}</td>
										<td class="col-md-3">{{ $message->created_at }}</td>
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="notification">
					<table class="table">
						<tr>
							<th>Subject</th>
							<th>Time</th>
						</tr>
						@foreach ($received as $message)
							@if ($message->sender_id == 0)
								<tr class="message
									@if ($message->hasread == 0)
										unread
									@endif" onclick="location.href='/message/{{ $message->id }}'">
									<td class="col-md-9">{{ $message->subject }}</td>
									<td class="col-md-3">{{ $message->created_at }}</td>
								</tr>
							@endif
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
