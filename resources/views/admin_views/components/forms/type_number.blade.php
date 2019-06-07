<div class="form-group {{ $class }}">
    <label for="{{ $field_name }}">{{ trans('button_input.'.$field_name) }}</label>

    <input type="number" class="form-control"
           id="{{ $field_name }}"
           name="{{ $field_name }}"
           placeholder="{{ trans('button_input.'.$field_name) }}"
           value="{{ old($field_name) ? old($field_name) : $value }}">

    @if ($errors->has($field_name))
        <div class="invalid-feedback d-block">
            {{ $errors->first($field_name) }}
        </div>
    @endif
</div>
