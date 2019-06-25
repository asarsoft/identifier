@component('admin_views.components.default.'.$action.'.'.$parameters['type'],
[
	'record' => $record[$key],
	'parameters' => $parameters,
	'name' => $key,
])
@endcomponent