@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'feature'])
	@endcomponent
	<div class="row my-5">
			<div class="col-xl-12 col-md-12 mb-3">
				<div class="border rounded shadow-sm">
					<div class="d-flex border-bottom py-2 px-3 w-100 align-items-center">
						<h3 class="h5 mr-auto mb-0">
							@component('admin_views.components.image', ['image' => $record->icon, 'width' => '', 'height' => '2rem', 'class' => 'rounded border mr-2'])
							@endcomponent
							{{ $record->trashed_detail->name }}
							<span class="badge badge-success">{{ $record->category->name }}</span>
							<p class="badge badge-light mb-0">{{ $record->trashed_detail->feature_type }}</p>
						</h3>
						<p class="h6 mb-0">
                            <span class="mr-3 h6"><small
			                            class="text-info">{{ trans('button_input.max_price') }}:</small> <b>{{ $record->max_price }}</b></span>
							<span class="h6"><small
										class="text-info">{{ trans('button_input.min_price') }}:</small> <b>{{ $record->min_price }}</b></span>
						</p>
					</div>
					<p class="px-3 pt-4">{{ $record->trashed_detail->description }}</p>

					<div class="d-flex px-3 w-100">
						<p class="mr-auto h6">
                            <span class="badge badge-info">
                                <span class="text-light">{{ trans('button_input.difficulty') }}: </span>
                                {{ $record->difficulty }}
                                %
                            </span>

							<span class="badge badge-light">
                                <span class="text-muted">{{ trans('button_input.approximate_time') }}: </span>
                                <span class="text-primary">{{ $record->approximate_time }}</span>
                                {{ trans('button_input.hours') }}
                            </span>
						</p>

						<p class="text-success d-flex align-items-center">
							<a href="{{ route('restore-feature', $record->id) }}"
							   class="btn btn-sm btn-success btn-lg"
							   role="button" aria-pressed="true">
								<i class="fas fa-recycle"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
	</div>
@endsection
