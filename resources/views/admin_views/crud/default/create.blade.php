@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => $fields['model']])
	@endcomponent

	@component('admin_views.components.default.table', ['fields' => $fields['fields'], 'records' => $records, 'identifier' => $identifier, 'model' => $fields['model']])
	@endcomponent
@endsection