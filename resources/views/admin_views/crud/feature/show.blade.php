@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'feature'])
	@endcomponent
	<div class="row my-5">
		@component('admin_views.components.feature', ['feature' => $record, 'detail' => $record->detail])
			<p class="text-success d-flex align-items-center">
				<a href="{{ route('edit-feature', $record->id) }}"
				   class="btn mr-2 btn-sm btn-outline-primary btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-pencil-alt"></i>
				</a>
				<a href="{{ route('destroy-feature', $record->id) }}" class="btn btn-sm btn-outline-danger btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-trash-alt"></i>
				</a>
			</p>
		@endcomponent
@endsection
