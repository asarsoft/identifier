@extends('layouts.admin_master')

@section('content')

@component('admin_views.components.crud_actions', ['module' => $model])
@endcomponent

<div class="col-md-12 mb-5">
	<form class="mb-4" method="post" action="{{ route($model.'.store', true) }}" enctype="multipart/form-data">
		@csrf

		@component('admin_views.components.default.form', ['fields' => $fields,'model' => $model, 'method' => 'create'])
		@endcomponent

		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
</div>
@endsection