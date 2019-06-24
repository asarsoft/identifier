<table class="table table-striped">
	<thead>
	<tr>
		@foreach($records->toArray()[0] as $header => $content)
			<th>
				{{ $header }}
			</th>
		@endforeach
	</tr>
	</thead>

	<tbody>
	@foreach($records as $record)
		<tr>
			@foreach($record->toArray() as $key => $value)
				<td>
					@if(is_array($value))
					@else
						@if(in_array($key, ['icon', 'image', 'avatar', 'cover'], true))
							@component('admin_views.components.image', ['image' => $value,'disk' => $module, 'width' => '', 'height' => '3rem','class' => 'rounded-circle border mr-2'])
							@endcomponent
						@else
							{{ $value }}
						@endif
					@endif
				</td>
			@endforeach
			<td>
				<a href="{{ route('edit-category', $record->id) }}"
				   class="btn mr-1 btn-sm btn-outline-primary btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-pencil-alt"></i>
				</a>
				<a href="{{ route('destroy-category', $record->id) }}" class="btn btn-sm btn-outline-danger btn-lg"
				   role="button" aria-pressed="true">
					<i class="fas fa-trash-alt"></i>
				</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>