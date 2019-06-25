@component('admin_views.components.default.index.'.$value['type'],
	[
		'record' => $record[$key],
		'parameters' => $parameters,
		'name' => $key,
	])
@endcomponent
