@extends('layouts.dashboard')

@section('title')
    Tags
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tags') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- form : search  --}}
                            <form action="{{ route('tags.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                        class="form-control" placeholder="Search for tags">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            @can('post_create')
                                <a href="{{ route('tags.create') }}" class="btn btn-primary float-right" role="button">
                                    Add new
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list tag -->
                        @if (count($tags))
                            @foreach ($tags as $tag)
                                <!-- tag list -->
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                    <label class="mt-auto mb-auto">
                                        <!-- show tag title -->
                                        {{ $tag->title }}
                                    </label>
                                    <div>
                                        <!-- edit -->
                                        @can('tag_update')
                                            <a href="{{ route('tags.edit', ['tag' => $tag]) }}"
                                                class="btn btn-sm btn-info"
                                                role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        <!-- delete -->
                                        @can('tag_delete')
                                            <form class="d-inline" role="alert"
                                                action="{{ route('tags.destroy', ['tag' => $tag]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </li>
                                <!-- end  tag list -->
                            @endforeach
                        @else
                            <p>
                                <strong>
                                    @if (request()->get('keyword'))
                                        Tag {{ request()->get('keyword') }} tidak ditemukan
                                    @else
                                        Tidak ada data tags
                                    @endif
                                </strong>
                            </p>
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
            // Event : delete
            $("form[role='alert']").submit(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: "Delete Tag",
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
