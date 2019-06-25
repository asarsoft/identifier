{{ $slot }}
@if($record != null)
	<img class="{{ @$class }}" src="{{asset('storage/'. @$parameters['disk'].'/'.$record)}}" style="width: {{ @$width ? $width : '3rem' }}; height: {{ @$height ? $height : 'auto' }}">
@else
	<img class="{{ @$class }}" src="{{asset('application_images/placeholder/no_image.jpg')}}" style="width: {{@$width ? $width : '3rem'}}; height: {{ @$height ? $height : 'auto' }}">
@endif
