<label for="{{ $key }}">
	{{ trans('button_input.'.$key) }}
</label>

<select class="form-control" name="{{ $key }}" id="{{ $key }}">
	@foreach($field['data'] as $option)
		<option value="{{ $option["id"] }}">{{ $option[$field['title']] }}</option>
	@endforeach
</select>