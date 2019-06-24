@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'category'])
	@endcomponent
 	<form class="mb-4" method="post" action="{{ route('update-category', ['id' => $record->id, 'sub_model' => @$records['category_detail']->id]) }}" enctype="multipart/form-data">
		@csrf
		<div class="form-group col-md-2 mx-0 px-0">
			<label for="icon">
				<span role="button" class="btn btn-outline-primary"><i class="mr-2 fas fa-image"></i>{{ trans('button_input.icon') }}</span>
			</label>
			<input class="d-none" name="icon" id="icon" type="file">
		</div>

		@component('admin_views.components.image', ['image' => $record->icon, 'width' => '', 'height' => '5rem', 'class' => 'rounded border mb-4 mt-2'])
			<h6 class="">
				{{ trans('button_input.cover_image') }}
			</h6>
		@endcomponent

		<div class="form-row">
			@component('admin_views.components.forms.select', ['field_name' => 'parent_id', 'options' => $records['categories'], 'name' => @$record->category->detail->name, 'selected' => $record->category_id])
			@endcomponent

			@component('admin_views.components.forms.type_text', ['field_name' => 'title', 'class' => 'col-md-2', 'value' => $record->title])
			@endcomponent
		</div>

		@if($records['category_detail'] !== false)
			@component('admin_views.crud.category.components.edit_detail', ['detail' => $records['category_detail'], 'languages' => $records['languages'], 'categories' => $records['categories']])
			@endcomponent
		@endif

		<div class="btn-group">
			<button type="submit" class="btn btn-primary">{{ trans('button_input.update') }}</button>
		</div>
		<div class="btn-group">
			<div class="dropdown">
				<button class="btn btn-outline-primary dropdown-toggle" type="button" id="language_selection" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{ trans('button_input.category_details') }}
				</button>
				<div class="dropdown-menu" aria-labelledby="language_selection">
					@foreach($records['languages'] as $language)
						<a class="dropdown-item" href="{{ route('edit-category', ['id' => $record->id, 'parameter' => $language->id]) }}"><span class="text-uppercase mr-2 text-primary">{{ $language->language_code }}</span> {{ $language->name }}
						</a>
					@endforeach
				</div>
			</div>
		</div>
	</form>
@endsection