<div class="col-xl-12 col-md-12 mb-3">
    <div class="border rounded shadow-sm">
        <div class="d-flex border-bottom py-2 px-3 w-100 align-items-center">
            <h3 class="h5 mr-auto mb-0">
                @component('admin_views.components.image', ['image' => $feature->icon, 'width' => '', 'height' => '2rem', 'class' => 'rounded border mr-2'])
                @endcomponent
                {{ $detail->name }}
                <span class="badge badge-success">{{ $feature->category->detail->name }}</span>
                <p class="badge badge-light mb-0">{{ $detail->feature_type }}</p>
            </h3>
            <p class="h6 mb-0">
                <span class="mr-3 h6">
                    <small class="text-info">{{ trans('button_input.max_price') }}:</small>
                    <b>{{ $feature->max_price }}</b>
                </span>
                <span class="h6">
                    <small class="text-info">{{ trans('button_input.min_price') }}:</small>
                    <b>{{ $feature->min_price }}</b>
                </span>
            </p>
        </div>
        <p class="px-3 pt-4">
            {{ str_limit($detail->description, 254) }}
        </p>

        <div class="d-flex px-3 w-100">
            <p class="mr-auto h6">
                <span class="badge badge-info">
                    <span class="text-light">{{ trans('button_input.difficulty') }}: </span>
                    {{ $feature->difficulty }}
                    %
                </span>

                <span class="badge badge-light">
                    <span class="text-muted">{{ trans('button_input.approximate_time') }}: </span>
                    <span class="text-primary">{{ $feature->approximate_time }}</span>
                    {{ trans('button_input.hours') }}
                </span>
            </p>

            {{ $slot }}
        </div>
    </div>
</div>
