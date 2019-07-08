<form class="mb-4" method="post" action="{{ route('store-'.$model, true) }}" enctype="multipart/form-data">
	@csrf

	@foreach($fields as $field_key => $field_value)
		@if(in_array($method, $field_value['available_in'], true))
			@component('admin_views.components.default.insert.'.$field_value['type'], ['field' => $field_value, 'key' => $field_key])
			@endcomponent
		@endif
	@endforeach

	<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
</form>