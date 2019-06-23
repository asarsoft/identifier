@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'category'])
	@endcomponent
	<form class="mb-4" method="post" action="{{ route('store-category', true) }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-md-2 mx-0 px-0">
			<label for="icon">
				<span role="button" class="btn btn-outline-primary"><i class="mr-2 fas fa-image"></i>{{ trans('button_input.icon') }}</span>
			</label>
			<input class="d-none" name="icon" id="icon" type="file">
		</div>

		<div class="form-row">
			@component('admin_views.components.forms.type_text', ['field_name' => 'title', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

			<div class="form-group col-md-3">
				<label for="parent_id">{{ trans('button_input.parent_id') }}</label>
				<select class="form-control" name="parent_id" id="parent_id">
					@foreach($records['categories'] as $category)
						<option value="{{$category->id}}">{{ $category->detail->name }}</option>
					@endforeach
				</select>
			</div>

		</div>

		@component('admin_views.crud.category.components.edit_detail', ['detail' => '', 'languages' => $records['languages'], 'categories' => $records['categories']])
		@endcomponent

		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
@endsection
