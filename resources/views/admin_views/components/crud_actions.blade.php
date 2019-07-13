<div class="mt-5 mb-4 col-md-12 px-0">
	<p class="my-4 h4">
		{{ trans('page_names.'.$module) }}
		<span class="float-right">
            <a href="{{ route($module.'.create') }}" class="btn btn-sm btn-primary btn-lg mr-1" role="button"
               aria-pressed="true">
	            <i class="fas fa-plus mr-1"></i>
	            {{ trans('page_names.'.$module."-create") }}
            </a>

            <a href="{{ route($module.'.recycle') }}" class="btn btn-sm btn-success btn-lg" role="button"
               aria-pressed="true">
	            <i class="fas fa-recycle mr-1"></i>
	            {{ trans('page_names.'.$module.'-recycle') }}
            </a>
        </span>
	</p>
</div>
