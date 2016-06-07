{{ csrf_field() }}

<div class="form-group">
	<label class="col-md-2 control-label" for="name">Name:</label>
	<div class="col-md-10">
		<p class="form-control-static">{{ $house->name }}</p>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label" for="city">City:</label>
	<div class="col-md-10">
		<p class="form-control-static">{{ $house->city }}</p>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label" for="district">District:</label>
	<div class="col-md-10">
		<p class="form-control-static">{{ $house->district }}</p>
	</div>
</div>


<div class="form-group">
	<label class="col-md-2 control-label" for="address">Address:</label>
	<div class="col-md-10">
		<p class="form-control-static">{{ $house->address }}</p>
	</div>
</div>


<hr>


<div class="form-group">
	<label class="col-md-2 control-label" for="area">Area:</label>
	<div class="col-md-10">
		<p class="form-control-static">{{ $house->area }}m<sup>2</sup></p>
	</div>
</div>


<div class="form-group">
	<label for="price" class="col-md-2 control-label">Price:</label>
	<div class="col-md-10">
		<input type="text" name="price" id="price" class="form-control" value="{{ $house->price }}" required="required">
	</div>
</div>


<div class="form-group">
	<label for="description" class="col-md-2 control-label">Description:</label>
	<div class="col-md-10">
		<textarea type="text" name="description" id="description" class="form-control" rows="7" required="required">{{ $house->description }}</textarea>
	</div>
</div>


<div class="form-group">
	<button type="submit" class="btn btn-default"> Edit </button>
</div>