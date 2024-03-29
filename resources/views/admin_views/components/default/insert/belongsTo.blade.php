<div class="form-group">
	<label for="{{ $key }}">
		{{ trans('button_input.'.$key) }}
	</label>
	<select class="form-control" name="{{ $key }}" id="{{ $key }}">
		<option selected value="">{{ trans('button_input.'.$key) }}...</option>
		@if(@$selected && $selected != null)
			@foreach($field['data'] as $option)
				<option @if($option["id"] == $selected) selected @endif value="{{ $option["id"] }}">{{ $option[$field['title']] }} - {{$selected}}</option>
			@endforeach
		@else
			@foreach($field['data'] as $option)
				<option value="{{ $option["id"] }}">{{ $option[$field['title']] }}</option>
			@endforeach
		@endif
	</select>

	@if ($errors->has($key))
		<div class="invalid-feedback d-block">
			{{ $errors->first($key) }}
		</div>
	@endif
</div>