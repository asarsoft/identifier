<hr class="my-4">

<h4 class="mb-3">{{ trans('page_names.'.$key) }}</h4>
@foreach ($field['fields'] as $sub_field_key => $sub_field_value)
	@if(in_array($method, $sub_field_value['available_in'], true))
		@component('admin_views.components.default.insert.'.$sub_field_value['type'], [
			'method' => $method,
			'field' => $sub_field_value,
			'key' => $sub_field_key,
			'record' => @$data ? $data[$sub_field_key] : '',
			'selected' => old($sub_field_key)
		])

		@endcomponent
	@endif
@endforeach