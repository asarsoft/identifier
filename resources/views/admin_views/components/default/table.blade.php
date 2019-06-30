<table class="table table-striped">
	<thead>
	<tr>
		@foreach($fields as $header_key => $header_value)
			@if(@$header_value['available_in'] && in_array('index', $header_value['available_in'], true))
				<th>
					{{ trans('button_input.'.$header_key) }}
				</th>
			@endif
		@endforeach
	</tr>
	</thead>

	<tbody>
	@foreach($records as $record)
		<tr>
			@foreach($fields as $key => $value)
				@if(@$value['available_in'] && in_array('index', $value['available_in'], true))
					<td>
						@component('admin_views.components.default.index.'.$value['type'],
							[
								'record' => $record,
								'parameters' => $value,
								'key' => $key,
								'identifier' => $identifier
							])
						@endcomponent
					</td>
				@endif
			@endforeach
		</tr>
	@endforeach
	</tbody>
</table>