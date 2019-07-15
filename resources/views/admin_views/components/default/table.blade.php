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
		<th>
			<i class="fas fa-toolbox mr-2"></i>{{ trans('button_input.actions') }}
		</th>
	</tr>
	</thead>

	<tbody>
	@foreach($data as $record)
		<tr>
			@foreach($fields as $key => $value)
				@if(@$value['available_in'] && in_array('index', $value['available_in'], true))
					<td>
						@component('admin_views.components.default.table.'.$value['type'],
							[
								'record' => $record,
								'parameters' => $value,
								'key' => $key,
								'model' => $model
							])
						@endcomponent
					</td>
				@endif
			@endforeach
			<td>
				<a href="{{ route($model.'.show', $record['id']) }}"
				   class="btn mr-2 btn-sm btn-outline-info btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-clipboard-list"></i>
				</a>
				<a href="{{ route($model.'.edit', $record['id']) }}"
				   class="btn mr-2 btn-sm btn-outline-primary btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-pencil-alt"></i>
				</a>
				<a href="{{ route($model.'.destroy', $record['id']) }}" class="btn btn-sm btn-outline-danger btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>