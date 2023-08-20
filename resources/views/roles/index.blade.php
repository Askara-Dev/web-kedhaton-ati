@extends('layouts.dashboard')

@section('title')
    Roles
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('roles') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- form : search --}}
                            <form action="{{ route('roles.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" type="search" value="{{ request()->get('keyword') }}"
                                        class="form-control" placeholder="Search for roles">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- button : add new --}}
                        <div class="col-md-6">
                            @can('role_create')
                                <a href="{{ route('roles.create') }}" class="btn btn-primary float-right" role="button">
                                    Add new
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list role -->
                        @forelse ($roles as $role)
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                <label class="mt-auto mb-auto">
                                    <!-- Role name -->
                                    {{ $role->name }}
                                </label>
                                <div>
                                    <!-- detail -->
                                    @can('role_detail')
                                        <a href="{{ route('roles.show', ['role' => $role]) }}" class="btn btn-sm btn-primary"
                                            role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    <!-- edit -->
                                    @can('role_update')
                                        <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn btn-sm btn-info"
                                            role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    <!-- delete -->
                                    @can('role_delete')
                                        <form class="d-inline" role="alert"
                                            action="{{ route('roles.destroy', ['role' => $role]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </li>
                        @empty
                            <p>
                                <strong>
                                    @if (request()->get('keyword'))
                                        Role "{{ request()->get('keyword') }}" tidak ditemukan
                                    @else
                                        Tidak ada data Role!
                                    @endif
                                </strong>
                            </p>
                        @endforelse

                        <!-- End list role -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            // Event : delete
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Delete Role",
                    text: "Apakah anda yakin?",
                    icon: 'warning',
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    confirmButtonText: "Iya",
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
