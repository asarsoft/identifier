<div class="form-group col-md-3">
	<label for="{{ $field_name }}">{{ trans('button_input.'.$field_name) }}</label>
	<select class="form-control" name="{{ $field_name }}" id="{{ $field_name }}">
		@foreach($options as $option)
			<option @if($selected == $option->id) selected @endif value="{{$option->id}}">{{ $option->name }}</option>
		@endforeach
	</select>
</div>
