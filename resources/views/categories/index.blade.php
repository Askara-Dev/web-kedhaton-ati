@extends('layouts.dashboard')

@section('title')
    Categories
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('categories') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- <form:search></form:search> --}}
                            <form action="{{ route('categories.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" type="search" class="form-control"
                                        placeholder="Search for categories" value="{{ request()->get('keyword') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            @can('category_create')
                                <a href="{{ route('categories.create') }}"
                                class="btn btn-primary float-right" role="button">
                                    Add new
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list category -->
                        {{-- @foreach ($categories as $category)
                    <li> {{ $category->title }} </li>
                @endforeach --}}
                        @if (count($categories))
                            @include('categories._category-list', [
                                'categories' => $categories,
                                'count' => 0,
                            ])
                        @else
                            @if (request()->get('keyword'))
                                kategori {{ request()->get('keyword') }} tidak ditemukan
                            @else
                                Tidak ada data kategori
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            // Event delete category
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Tidak",
                    reverseButtons: true,
                    confirmButtonText: "Ya",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // todo: process of deleting categories
                        event.target.submit();
                    }
                });


            });
        });
    </script>
@endpush
