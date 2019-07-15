@if($record && $record->{$parameters['method']} )
	<a href="{{ route(strtolower(class_basename($model)).'.show', $record->{$parameters['method']}->id) }}">
		{{ @$parameters['title'] ? $record->{$parameters['method']}->{$parameters['title']} : $record->{$parameters['method']}->id }}
	</a>
@else
	<a class="text-decoration-none" href="#">
		—
	</a>
@endif