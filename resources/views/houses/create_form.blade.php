@inject('cities', 'App\Http\Utilities\City')

{{ csrf_field() }}
<input type="hidden" name="provider_id" value="{{ $current_user->id }}">
<input type="hidden" name="type" value="{{ $type }}">
<input type="hidden" name="status" value="unauthenticated">

<div class="form-group">
	<label for="name" class="col-md-2 control-label">Name:</label>
	<div class="col-md-10">
		<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required="required">
	</div>
</div>

<div class="form-group">
	<label for="city" class="col-md-2 control-label">City:</label>
	<div class="col-md-10">
		<select id="city" name="city" class="form-control">
			@foreach ($cities::all() as $city => $districts)
				<option value="{{ $city }}">{{ $city }}</option>
			@endforeach
		</select>
	</div>
</div>


<div class="form-group">
	<label for="district" class="col-md-2 control-label">District:</label>
	<div class="col-md-10">
		<input type="text" name="district" id="district" class="form-control" value="{{ old('district') }}" required="required">
	</div>
</div>


<div class="form-group">
	<label for="address" class="col-md-2 control-label">Address:</label>
	<div class="col-md-10">
		<input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required="required">
	</div>
</div>

<hr>

<div class="form-group">
	<label for="price" class="col-md-2 control-label">@if ($type == 'sell')
		Price:
	@else
		Price/month:
	@endif</label>
	<div class="col-md-10">
		<input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" required="required">
	</div>
</div>


<div class="form-group">
	<label for="area" class="col-md-2 control-label">Area:</label>
	<div class="col-md-10">
		<input type="text" name="area" id="area" class="form-control" value="{{ old('area') }}" required="required">
	</div>
</div>


<div class="form-group">
	<label for="description" class="col-md-2 control-label">Description:</label>
	<div class="col-md-10">
		<textarea type="text" name="description" id="description" class="form-control" rows="7" required="required">{{ old('description') }}</textarea>
	</div>
</div>

<hr>

<div class="form-group">
	<label for="description" class="col-md-2 control-label">Choose an agent:</label>
	<div class="col-md-10">
		<select id="agent_id" name="agent_id" class="form-control">
			@foreach ($agents as $agent)
				<option value="{{ $agent['id'] }}">{{ $agent['name'] }}</option>
			@endforeach
		</select>
	</div>
</div>

<div class="form-group">
	<div class="col-md-12" align="center">
		<button type="submit" class="btn btn-default"> {{ ucfirst($type) }} the house </button>
	</div>
</div>

<!-- Photos, Do it later -->
<!--
<div class="form-group">
	<label for="photos">Photos:</label>
	<input type="file" name="photos" id="photos" class="form-control" value="{{ old('photos') }}">
</div>
-->