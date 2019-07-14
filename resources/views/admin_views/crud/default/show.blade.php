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
@endsection