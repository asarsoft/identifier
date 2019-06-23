@extends('layouts.admin_master')

@section('content')
	@component('admin_views.components.crud_actions', ['module' => 'category'])
	@endcomponent
	<div class="row my-5">
		<ul class="list-group">
			<li class="list-group-item d-flex justify-content-between align-items-center">
				{{$record->title}}
				<div class="badge badge-primary badge-pill">
					<p class="text-success d-flex align-items-center">
						<a href="{{ route('edit-feature', $record->id) }}"
						   class="btn mr-2 btn-sm btn-outline-primary btn-lg"
						   role="button" aria-pressed="true">
							<i class="fas fa-pencil-alt"></i>
						</a>
						<a href="{{ route('destroy-feature', $record->id) }}" class="btn btn-sm btn-outline-danger btn-lg"
						   role="button" aria-pressed="true">
							<i class="fas fa-trash-alt"></i>
						</a>
					</p>
				</div>
			</li>
		</ul>
	</div>
@endsection
