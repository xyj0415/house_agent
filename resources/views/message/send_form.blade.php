{{ csrf_field() }}
<div class="form-group">
	<label for="receiver" class="col-md-2 control-label">To:</label>
	<div class="col-md-10">
		<input type="text" name="receiver" id="receiver" class="form-control" value="{{ old('receiver') }}" required="required">
	</div>
</div>

<div class="form-group">
	<label for="subject" class="col-md-2 control-label">Subject:</label>
	<div class="col-md-10">
		<input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject') }}" required="required">
	</div>
</div>

<div class="form-group">
	<label for="content" class="col-md-2 control-label">Content:</label>
	<div class="col-md-10">
		<textarea type="text" name="content" id="content" class="form-control" rows="20"></textarea>
	</div>
</div>

<div class="form-group">
	<div class="col-md-10 col-md-offset-2">
		<button type="submit" class="btn btn-default">
			Send
		</button>
	</div>
</div>