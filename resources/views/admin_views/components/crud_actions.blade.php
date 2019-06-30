<div class="mt-5 mb-4 col-md-12 px-0">
	<p class="my-4 h4">
		{{ trans('page_names.'.Request::route()->getName()) }}
		<span class="float-right">
            <a href="{{ route('create'.'-'.$module) }}" class="btn btn-sm btn-primary btn-lg mr-1" role="button"
               aria-pressed="true">
	            <i class="fas fa-plus mr-1"></i>
	            {{ trans('page_names.create-'.$module) }}
            </a>
            <a href="{{ route('recycle'.'-'.$module) }}" class="btn btn-sm btn-success btn-lg" role="button"
               aria-pressed="true">
	            <i class="fas fa-recycle mr-1"></i>
	            {{ trans('page_names.recycle-'.$module) }}
            </a>
        </span>
	</p>
</div>
