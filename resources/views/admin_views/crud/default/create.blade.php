@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => $model])
	@endcomponent

	<form class="mb-4" method="post" action="{{ route('store-'.$model, true) }}" enctype="multipart/form-data">
		@csrf
		
		@component('admin_views.components.default.form', ['fields' => $fields,'model' => $model, 'method' => 'create'])
		@endcomponent
		
		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
@endsection