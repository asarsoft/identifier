<tr>
	<th scope="row">1</th>
	<td>
		@component('admin_views.components.image', ['image' => $record->icon, 'disk' => 'category/', 'width' => '', 'height' => '3rem', 'class' => 'rounded-circle border mr-2'])
		@endcomponent
	</td>
	<td>{{ $name }}</td>
	<td>{!! $description  !!}</td>
</tr>
