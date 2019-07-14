@if($record->{$parameters['method']} )
	<a href="{{ route(strtolower(class_basename($parameters['model'])).'.show', $record['id']) }}">
		{{ $record->{$parameters['method']}->{$parameters['title']} }}
	</a>
@else
	<a href="#">
		—
	</a>
@endif