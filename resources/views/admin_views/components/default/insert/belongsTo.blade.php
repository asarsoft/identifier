<div class="form-group">
	<label for="{{ $key }}">
		{{ trans('button_input.'.$key) }}
	</label>
	
	<select class="form-control" name="{{ $key }}" id="{{ $key }}">
		@if(@$selected)
			@foreach($field['data'] as $option)
				<option @if($option["id"] == $selected) selected @endif value="{{ $option["id"] }}">{{ $option[$field['title']] }}</option>
			@endforeach
		@else
			<option selected value="">{{ trans('button_input.'.$key) }}...</option>
			@foreach($field['data'] as $option)
				<option value="{{ $option["id"] }}">{{ $option[$field['title']] }}</option>
			@endforeach
		@endif
	</select>
</div>