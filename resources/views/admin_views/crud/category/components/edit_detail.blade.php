<hr class="my-4">

<h4 class="mb-3">Category Details</h4>

<div class="form-row">
	@component('admin_views.components.forms.type_text', ['field_name' => 'name', 'class' => 'col-md-7', 'value' => @$detail->name])
	@endcomponent
</div>

<div class="form-row">
	@component('admin_views.components.forms.select', ['field_name' => 'language_id', 'options' => $languages, 'selected' => @$detail->language_id])
	@endcomponent
</div>

@component('admin_views.components.text_editor', ['field_name' => 'description', 'value' => @$detail->description])
@endcomponent
