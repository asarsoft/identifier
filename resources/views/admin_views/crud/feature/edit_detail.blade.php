@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'feature-detail'])
	@endcomponent

		<h4 class="mb-3">Feature Details</h4>

		<div class="form-row">
			@component('admin_views.components.forms.type_text', ['field_name' => 'name', 'class' => 'col-md-7', 'value' => ''])
			@endcomponent
		</div>

		<div class="form-row">
			<div class="form-group col-md-3">
				<label for="language_id">Language</label>
				<select class="form-control" name="language_id" id="language_id">
					@foreach($languages as $language)
						<option value="{{$language->id}}">{{ $language->name }}</option>
					@endforeach
				</select>
			</div>
			@component('admin_views.components.forms.select', ['field_name' => 'language_id', 'options' => $languages, 'name' => $feature->name, 'selected' => $feature->language_id])
			@endcomponent


			@component('admin_views.components.forms.type_text', ['field_name' => 'feature_type', 'class' => 'col-md-2', 'value' => ''])
			@endcomponent

		</div>

		@component('admin_views.components.text_editor', ['field_name' => 'description'])
		@endcomponent

		<button type="submit" class="btn btn-primary">{{ trans('button_input.create') }}</button>
	</form>
@endsection
