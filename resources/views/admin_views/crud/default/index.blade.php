@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => $model])
	@endcomponent

	@component('admin_views.components.default.table', ['fields' => $fields, 'data' => $data, 'identifier' => $identifier, 'model' => $model])
	@endcomponent
@endsection