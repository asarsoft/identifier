@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.field_render', ['records' => $records, 'fields' => $fields, 'action' => 'index'])
	@endcomponent
@endsection