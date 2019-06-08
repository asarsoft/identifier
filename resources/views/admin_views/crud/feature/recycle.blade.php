@extends('layouts.admin_master')

@section('content')
    @component('admin_views.components.crud_actions', ['module' => 'feature'])
    @endcomponent
    <div class="row my-5">
        @foreach($features as $feature)
            @component('admin_views.components.feature', ['feature' => $feature, 'detail' => $feature->trashed_detail])
                <p class="text-success d-flex align-items-center">
                    <a href="{{ route('restore-feature', $feature->id) }}"
                       class="btn btn-sm btn-success btn-lg"
                       role="button" aria-pressed="true">
                        <i class="fas fa-recycle"></i>
                    </a>
                </p>
            @endcomponent
        @endforeach
    </div>
@endsection
