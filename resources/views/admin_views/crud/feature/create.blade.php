@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'feature'])
	@endcomponent
	<form class="mb-4" method="post" action="{{ route('store-feature', true) }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-md-2 mx-0 px-0">
			<label for="icon">
				<span role="button" class="btn btn-outline-primary"><i class="mr-2 fas fa-image"></i>{{ trans('button_input.icon') }}</span>
			</label>
			<input class="d-none" name="icon" id="icon" type="file">
		</div>

		<div class="form-row">
			@component('admin_views.components.forms.type_text', ['field_name' => 'min_price', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

			@component('admin_views.components.forms.type_text', ['field_name' => 'max_price', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'difficulty', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'approximate_time', 'class' => 'col-md-4', 'value' => ''])
			@endcomponent

			@component('admin_views.components.forms.type_number', ['field_name' => 'priority', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

			<div class="form-group col-md-3">
				<label for="category_id">Category</label>
				<select class="form-control" name="category_id" id="category_id">
					@foreach($records['categories'] as $category)
						<option value="{{$category->id}}">{{ $category->detail->name }}</option>
					@endforeach
				</select>
			</div>

		</div>

		<hr class="my-4">

		<h4 class="mb-3">Feature Details</h4>

		<div class="form-row">
			@component('admin_views.components.forms.type_text', ['field_name' => 'name', 'class' => 'col-md-7', 'value' => ''])
			@endcomponent
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="language_id">Language</label>
				<select class="form-control" name="language_id" id="language_id">
					@foreach($records['languages'] as $language)
						<option value="{{$language->id}}">{{ $language->name }}</option>
					@endforeach
				</select>
			</div>

			@component('admin_views.components.forms.type_text', ['field_name' => 'feature_type', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

		</div>

		@component('admin_views.components.text_editor', ['field_name' => 'description'])
		@endcomponent

		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
@endsection
