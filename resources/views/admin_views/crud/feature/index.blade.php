@extends('layouts.admin_master')

@section('content')
    @component('admin_views.components.crud_actions', ['module' => 'feature'])
    @endcomponent
    <div class="row my-5">
        @foreach($data as $feature)
            @component('admin_views.components.feature', ['feature' => $feature, 'detail' => $feature->detail])
                <p class="text-success d-flex align-items-center">
                    <a href="{{ route('edit-feature', $feature->id) }}"
                       class="btn mr-2 btn-sm btn-outline-primary btn-lg"
                       role="button" aria-pressed="true">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                    <a href="{{ route('destroy-feature', $feature->id) }}"
                       class="btn btn-sm btn-outline-danger btn-lg"
                       role="button" aria-pressed="true">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </p>
            @endcomponent
        @endforeach
    </div>
@endsection
