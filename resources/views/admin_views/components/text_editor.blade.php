@section('style')
	<link href="{{ asset('application_css/external/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endsection

<div class="mb-4">
	<label for="{{ $field_name }}">{{ trans('button_input.'.$field_name) }}</label>
	<textarea id="{{ $field_name }}" name="{{ $field_name }}">{{@$value}}</textarea>
</div>

@section('script')
	<script src="{{ asset('application_js/external/summernote-bs4.js') }}"></script>
	<script>
        var field_name = '{{ $field_name }}';
        $('#' + field_name).summernote({
            placeholder: '{{ trans('button_input.'.@$field_name) }}',
            tabsize: 2,
            height: 200
        });
	</script>
@endsection
