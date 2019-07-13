@if($record->{$parameters['method']} )
	<a href="{{ route('show-'.$parameters['method'], $record['id']) }}">
		{{ $record->{$parameters['method']}->{$parameters['title']} }}
	</a>
@else
	<a href="#">
		—
	</a>
@endif