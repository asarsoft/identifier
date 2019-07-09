<div class="form-group">
    <label for="{{ $key }}">{{ trans('button_input.'.$key) }}</label>

    <input type="number" class="form-control" id="{{ $key }}" name="{{ $key }}"
        placeholder="{{ trans('button_input.'.$key) }}" value="{{ old($key) ? old($key) : @$record }}">

    @if ($errors->has($key))
        <div class="invalid-feedback d-block">
            {{ $errors->first($key) }}
        </div>
    @endif
</div>