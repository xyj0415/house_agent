@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a href="#new" data-toggle="tab">New Message</a></li>
				<li><a href="#check" data-toggle="tab">Check Messages</a></li>
				<li><a href="#notification" data-toggle="tab">Notifications</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<div class="tab-content">
				<div class="tab-pane in active" id="new">
					<form class="form-horizontal" action="">
						@include('messages.send_form')
					</form>
				</div>
				<div class="tab-pane" id="check">
					<ul class="nav nav-tabs">
						<li><a href="#inbox" data-toggle="tab">Inbox</a></li>
						<li><a href="#outbox" data-toggle="tab">Outbox</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane" id="inbox">
							aaa
						</div>
						<div class="tab-pane" id="outbox">
							bbb
						</div>
					</div>
				</div>
				<div class="tab-pane" id="notification">
					<table class="table table-striped">
						@foreach ($received as $message)
							<tr>
								<td>{{ $message->title }}</td>
								<td>{{ $message->content }}</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@stop