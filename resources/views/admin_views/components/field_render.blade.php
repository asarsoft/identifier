@component('admin_views.components.default.'.$action.'.'.$value['type'],
[
	'record' => $record[$key],
	'parameters' => $value,
	'name' => $key,
	'model' => $fields['model'],
])
@endcomponent



