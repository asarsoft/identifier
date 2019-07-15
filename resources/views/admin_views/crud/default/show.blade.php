@extends('layouts.admin_master')

@section('content')

	@component('admin_views.components.crud_actions', ['module' => $model])
	@endcomponent

	@component('admin_views.components.default.detail_table', [
	'fields' => $identifier['main_identifier']['fields'],
	'data' => $data,
	'identifier' => $identifier['main_identifier'],
	'method' => $method
	])
	@endcomponent

	@foreach($data->getRelations() as $key => $relationship)
		<div class="py-4">
			@component('admin_views.components.crud_actions', ['module' => strtolower(class_basename($identifier['sub_identifier'][$key]['model']))])
			@endcomponent

			@if(!$relationship instanceof Illuminate\Database\Eloquent\Collection)
				@component('admin_views.components.default.detail_table', [
				'fields' => $identifier['sub_identifier'][$key]['fields'],
				'data' => $relationship,
				'identifier' => $identifier['sub_identifier'][$key],
				'method' => $method
				])
				@endcomponent

			@else
				@component('admin_views.components.default.table', [
				'fields' => $identifier['sub_identifier'][$key]['fields'],
				'data' => $relationship,
				'model' => $model
				])
				@endcomponent
			@endif
		</div>
	@endforeach

@endsection