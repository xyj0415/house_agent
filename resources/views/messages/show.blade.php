@extends('layout')

@inject('user', 'App\User')

@section('content')
	<a href="/message">&lt;&lt;back</a>
	<form class="form-horizontal">
		<div class="form-group">
			<label for="sender" class="col-md-2 control-label">From:</label>
			<div class="col-md-10">
				<p class="form-control-static">
					@if ($message->sender_id != 0)
						{{ $user::find($message->sender_id)->name }}&lt;{{ $user::find($message->sender_id)->email }}&gt;
					@else
						System Notification
					@endif
				</p>
			</div>
		</div>

		<div class="form-group">
			<label for="receiver" class="col-md-2 control-label">To:</label>
			<div class="col-md-10">
				<p class="form-control-static">{{ $user::find($message->receiver_id)->name }}&lt;{{ $user::find($message->receiver_id)->email }}&gt;</p>
			</div>
		</div>

		<div class="form-group">
			<label for="subject" class="col-md-2 control-label">Subject:</label>
			<div class="col-md-10">
				<p class="form-control-static">{{ $message->subject }}</p>
			</div>
		</div>

		<div class="form-group">
			<label for="content" class="col-md-2 control-label">Content:</label>
			<div class="col-md-10">
				<p class="form-control-static">{{ $message->content }}</p>
			</div>
		</div>
	</form>
@stop