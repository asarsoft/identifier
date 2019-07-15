<table class="table table-striped">
{{--	{{ dd($data, $fields) }}--}}
	<tbody>
	@if($data)
		@foreach($fields as $field_key => $field_value)
			@if(@$field_value['available_in'] && in_array($method, $field_value['available_in'], true))
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
	@else
		<p class="text-center">Center aligned text on all viewport sizes.</p>
	@endif
	</tbody>
</table>