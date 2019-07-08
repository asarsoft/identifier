<a href="{{ route('show-'.$parameters['model'], $record['id']) }}">
	{{ $record[$parameters['belongs']][$parameters['title']] ? $record[$parameters['belongs']][$parameters['title']] : "—"}}
</a>