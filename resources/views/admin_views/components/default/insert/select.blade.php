<div class="form-group">
    <label for="{{ $key }}">
        {{ trans('button_input.'.$key) }}
    </label>

    <select class="form-control" name="{{ $key }}" id="{{ $key }}">
        @if(@$selected)
            @foreach($field['options'] as $option_key => $option)
                <option @if($option_key == $selected) selected @endif value="{{ $option_key }}">
                    {{ $option }}
                </option>
            @endforeach
        @else
            <option selected value="">{{ trans('button_input.'.$option_key) }}...</option>
            @foreach($field['options'] as $option_key => $option)
                <option value="{{ $option_key }}">{{ $option }}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has($key))
        <div class="invalid-feedback d-block">
            {{ $errors->first($key) }}
        </div>
    @endif
</div>