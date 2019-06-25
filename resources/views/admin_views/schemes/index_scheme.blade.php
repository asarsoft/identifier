@component('admin_views.components.crud_actions', ['module' => $fields['model']])
@endcomponent

<table class="table table-striped">
	<thead>
	<tr>
		@foreach($fields['fields'] as $key => $value)
		@endforeach
	</tr>
	</thead>

	<tbody>
	@foreach($records as $record)
		<tr>
			@foreach($fields['fields'] as $key => $value)
				<td>
					@component('admin_views.components.field_render', ['records' => $records, 'fields' => $fields, 'action' => 'index'])
					@endcomponent
				</td>
			@endforeach
		</tr>
	@endforeach
	</tbody>
</table>

