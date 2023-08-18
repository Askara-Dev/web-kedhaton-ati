@extends('layouts.dashboard')

@section('title')
    Add Category
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_category') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_category_title" class="font-weight-bold">
                                Title
                            </label>
                            <input id="input_category_title" value="{{ old('title') }}" name="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" placeholder="Judul" />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_category_slug" class="font-weight-bold">
                                Slug
                            </label>
                            <input id="input_category_slug" value="{{ old('slug') }}" name="slug" type="text"
                                class="form-control @error('slug') is-invalid @enderror" readonly placeholder="Slug" />
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- thumbnail -->
                        <div class="form-group">
                            <label for="input_category_thumbnail" class="font-weight-bold">
                                Thumbnail
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button id="button_category_thumbnail" data-input="input_category_thumbnail"
                                        data-preview="holder" class="btn btn-primary" type="button">
                                        Browse
                                    </button>
                                </div>
                                <input id="input_category_thumbnail" name="thumbnail" value="{{ old('thumbnail') }}"
                                    type="text" class="form-control @error('thumbnail') is-invalid @enderror"
                                    placeholder="Thumbnail" readonly />
                                @error('thumbnail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- preview thumbnail --}}
                            <div id="holder" class="mt-2">

                            </div>
                        </div>
                        <!-- parent_category -->
                        <div class="form-group">
                            <label for="select_category_parent" class="font-weight-bold">Parent Category</label>
                            <select id="select_category_parent" name="parent_category" data-placeholder="Pilih Category"
                                class="custom-select w-100">
                                @if (old('parent_category'))
                                    <option value="{{ old('parent_category')->id }}" selected>
                                        {{ old('parent_category')->title }}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <!-- description -->
                        <div class="form-group">
                            <label for="input_category_description" class="font-weight-bold">
                                Description
                            </label>
                            <textarea id="input_category_description" name="description"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Deskripsi" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="float-right">
                            <a class="btn btn-warning px-4" href="{{ route('categories.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-external')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
    <script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
    {{-- file manager --}}
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
@endpush

@push('javascript-internal')
    <script>
        $(function() {
            function generateSlug(value) {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "");
            }

            //parent category
            $('#select_category_parent').select2({
                theme: 'bootstrap4',
                language: "",
                allowClear: true,
                ajax: {
                    url: "{{ route('categories.select') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.title,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });

            // event:input
            $('#input_category_title').change(function() {
                let title = $(this).val();
                let parent_category = $('#select_category_parent').val() ?? "";
                $('#input_category_slug').val(generateSlug(title + " " + parent_category));
            });

            // event:select
            $('#select_category_parent').change(function() {
                let title = $('#input_category_slug').val();
                let parent_category = $(this).val() ?? "";
                $('#input_category_slug').val(generateSlug(title + " " + parent_category));
            });

            // Event:thumbnail
            $('#button_category_thumbnail').filemanager('image');



        });
    </script>
@endpush
