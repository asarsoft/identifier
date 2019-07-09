<div class="form-group col-md-2 mx-0 px-0">
    <label for="{{ $key }}">
        <span role="button" class="btn btn-outline-primary">
            <i class="mr-2 fas fa-image"></i>
            {{ trans('button_input.'.$key) }}
        </span>
    </label>
    
    <input class="d-none" name="{{ $key }}" id="{{ $key }}" type="file">
</div>
@if(@$record)
    @component('admin_views.components.image', [
    'image' => $record,
    'width' => '',
    'height' => '5rem',
    'class' => 'rounded border mb-4 mt-2'
    ])
        <h6 class="">
            {{ trans('button_input.cover_image') }}
        </h6>
    @endcomponent
@endif

{{ $slot }}