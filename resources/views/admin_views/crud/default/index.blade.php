@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'category'])
	@endcomponent

	@component('admin_views.components.lazy_list', ['records' => $records, 'module' => 'category/'])
	@endcomponent
@endsection