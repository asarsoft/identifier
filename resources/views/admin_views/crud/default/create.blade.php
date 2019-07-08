@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => $model])
	@endcomponent

	@component('admin_views.components.default.form', ['fields' => $fields,'model' => $model, 'method' => 'create'])
	@endcomponent
@endsection