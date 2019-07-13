<a href="{{ route($parameters['model'].'.show', $record['id']) }}">
	{{ $record[$parameters['belongs']][$parameters['title']] ? $record[$parameters['belongs']][$parameters['title']] : "—"}}
</a>