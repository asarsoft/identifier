@component('admin_views.components.crud_actions', ['module' => $fields['model']])
@endcomponent

@foreach($records as $record)
	@foreach($fields['fields'] as $key => $value)
		@if(@$value['available_in'] && in_array($action, $value['available_in'], true))
			@component('admin_views.components.default.'.$value['type'],
			[
				'record' => $record[$key],
				'parameters' => $value,
				'name' => $key,
				'model' => $fields['model'],
				'action' => $action
			])
			@endcomponent
		@endif
	@endforeach
@endforeach




