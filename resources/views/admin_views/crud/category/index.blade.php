@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'category'])
	@endcomponent
	<div class="row my-5">
		@foreach($records as $category)
			<div class="col-xl-12 col-md-12 mb-3">
				<div class="border rounded shadow-sm">
					<div class="d-flex border-bottom py-2 px-3 w-100 align-items-center">
						<h3 class="h5 mr-auto mb-0">
							@component('admin_views.components.image', ['image' => $category->icon, 'width' => '', 'height' => '2rem', 'class' => 'rounded border mr-2'])
							@endcomponent
							{{ $category->detail->name }}
							<span class="badge badge-success">{{ $category->category ? trans('button_input.parent_id').': '.$category->category->detail->name : null}}</span>
							<a href="{{ route('edit-category', $category->id) }}"
							   class="btn mr-1 btn-sm btn-outline-primary btn-lg"
							   role="button" aria-pressed="true">
								<i class="fas fa-pencil-alt"></i>
							</a>
							<a href="{{ route('destroy-category', $category->id) }}" class="btn btn-sm btn-outline-danger btn-lg"
							   role="button" aria-pressed="true">
								<i class="fas fa-trash-alt"></i>
							</a>
						</h3>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection
