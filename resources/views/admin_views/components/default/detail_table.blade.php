<table class="table table-striped">
	<tbody>
	@foreach($fields as $field_key => $field_value)
		@if($field_value['available_in'] && in_array($method, $field_value['available_in'], true))
			<tr>
				<th>{{ trans('button_input.'.$field_key) }}</th>

				<td>
					@component('admin_views.components.default.table.'.$field_value['type'],
						[
							'record' => $data,
							'parameters' => $field_value,
							'key' => $field_key,
							'model' => $identifier['model']
						])

					@endcomponent
				</td>
			</tr>
		@endif
	@endforeach
	</tbody>
</table>