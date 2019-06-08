<div class="my-4 col-md-12">
    <p class="my-4 h4">
        {{ trans('page_names.'.Request::route()->getName()) }}
        <a href="{{ route('create'.'-'.$module) }}" class="btn btn-sm btn-primary btn-lg" role="button"
           aria-pressed="true">{{ trans('page_names.create-'.$module) }}</a>
        <a href="{{ route('recycle'.'-'.$module) }}" class="btn btn-sm btn-secondary btn-lg" role="button"
           aria-pressed="true">{{ trans('page_names.recycle-'.$module) }}</a>
    </p>
</div>
