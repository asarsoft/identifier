<form class="mb-4" method="post" action="{{ route('store-'.$model, true) }}" enctype="multipart/form-data">
	@csrf

	@foreach($fields as $field)
		@if(in_array($method, $field['available_in'], true))
			@component('admin_views.components.default.insert.'.$field['type'], ['field' => $field])
			@endcomponent
		@endif
	@endforeach

	<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
</form>