<div class="mt-5 mb-4 col-md-12 px-0">
	<p class="my-4 h4">
		{{ trans('page_names.'.$module) }}
		<span class="float-right">
            <a href="{{ route($module.'.create') }}" class="btn btn-primary font-weight-bold mr-1" role="button"
               aria-pressed="true">
	            <i class="fas fa-plus mr-1"></i>
	            {{ trans('page_names.'.$module."-create") }}
            </a>

            <a href="{{ route($module.'.recycle') }}" class="btn btn-success font-weight-bold" role="button"
               aria-pressed="true">
	            <i class="fas fa-recycle mr-1"></i>
	            {{ trans('page_names.'.$module.'-recycle') }}
            </a>
        </span>
	</p>
</div>
