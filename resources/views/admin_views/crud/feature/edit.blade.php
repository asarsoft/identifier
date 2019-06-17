@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'feature'])
	@endcomponent
	<form class="mb-4" method="post" action="{{ route('update-feature') }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-md-2 mx-0 px-0">
			<label for="icon">
				<span role="button" class="btn btn-outline-primary"><i class="mr-2 fas fa-image"></i>{{ trans('button_input.icon') }}</span>
			</label>
			<input class="d-none" name="icon" id="icon" type="file">
		</div>

		@component('admin_views.components.image', ['image' => $record->icon, 'width' => '', 'height' => '2rem', 'class' => 'rounded border mr-2'])
		@endcomponent

		<div class="form-row">
			@component('admin_views.components.forms.select', ['field_name' => 'category_id', 'options' => $categories, 'name' => $record->category->detail->name, 'selected' => $record->category_id])
			@endcomponent

			@component('admin_views.components.forms.type_text', ['field_name' => 'min_price', 'class' => 'col-md-2', 'value' => $record->min_price])
			@endcomponent

			@component('admin_views.components.forms.type_text', ['field_name' => 'max_price', 'class' => 'col-md-2', 'value' => $record->max_price])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'approximate_time', 'class' => 'col-md-4', 'value' => $record->approximate_time])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'difficulty', 'class' => 'col-md-2', 'value' => $record->difficulty])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'priority', 'class' => 'col-md-2', 'value' => $record->priority])
			@endcomponent


		</div>

		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
@endsection
