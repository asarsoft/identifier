@if($record != null)
	<img class="{{ @$class }} rounded-circle"
	     src="{{asset('storage/'. @$parameters['disk'].'/'.$record)}}"
	     style="width: {{ @$width ? $width : 'auto' }}; height: {{ @$height ? $height : '1.5rem' }}" alt="asarsoft">
@else
	<img class="{{ @$class }} rounded-circle"
	     src="{{asset('application_images/placeholder/no_image.jpg')}}"
	     style="width: {{@$width ? $width : 'auto'}}; height: {{ @$height ? $height : '1.5rem' }}" alt="asarsoft">
@endif
{{ $slot }}
