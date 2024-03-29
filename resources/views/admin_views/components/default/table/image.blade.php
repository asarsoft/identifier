@if($record[$key] != null)
	<img class="{{ @$class }} rounded-circle"
	     @if(@$parameters['disk'])
	     src="{{asset('storage/'. @$parameters['disk'].'/'.$record[$key])}}"
	     @else
	     src="{{asset('storage/'.$record[$key])}}"
	     @endif
	     style="width: {{ @$width ? $width : '1.5rem' }}; height: {{ @$height ? $height : '1.5rem' }}" alt="asarsoft">
@else
	<img class="{{ @$class }} rounded-circle"
	     src="{{asset('application_images/placeholder/no_image.jpg')}}"
	     style="width: {{@$width ? $width : '1.5rem'}}; height: {{ @$height ? $height : '1.5rem' }}" alt="asarsoft">
@endif
{{ $slot }}
