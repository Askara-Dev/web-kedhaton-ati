@extends('layouts.dashboard')

@section('title')
    Edit post
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('edit_post', $post) }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{-- form : post --}}
            <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row d-flex align-items-stretch">
                            <div class="col-md-8">
                                <!-- title -->
                                <div class="form-group">
                                    <label for="input_post_title" class="font-weight-bold">
                                        Title
                                    </label>
                                    <input id="input_post_title" value="{{ old('title', $post->title) }}" name="title"
                                        type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="judul" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- slug -->
                                <div class="form-group">
                                    <label for="input_post_slug" class="font-weight-bold">
                                        Slug
                                    </label>
                                    <input id="input_post_slug" value="{{ old('slug', $post->slug) }}" name="slug"
                                        type="text" class="form-control @error('slug') is-invalid @enderror"
                                        placeholder="slug" readonly />
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- thumbnail -->
                                <div class="form-group">
                                    <label for="input_post_thumbnail" class="font-weight-bold">
                                        Thumbnail
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button id="button_post_thumbnail" data-input="input_post_thumbnail"
                                                class="btn btn-primary" type="button">
                                                Browse
                                            </button>
                                        </div>
                                        <input id="input_post_thumbnail" name="thumbnail"
                                            value="{{ old('thumbnail', asset($post->thumbnail)) }}" type="text"
                                            class="form-control @error('thumbnail') is-invalid @enderror"
                                            placeholder="thumbnail" readonly />
                                        @error('thumbnail')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- description -->
                                <div class="form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Description
                                    </label>
                                    <textarea id="input_post_description" name="description" placeholder="deskripsi"
                                        class="form-control @error('description') is-invalid @enderror" rows="3">
                                        {{ old('description', $post->description) }}
                                    </textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- content -->
                                <div class="form-group">
                                    <label for="input_post_content" class="font-weight-bold">
                                        Content
                                    </label>
                                    <textarea id="input_post_content" name="content" placeholder="konten"
                                        class="form-control @error('content') is-invalid @enderror" rows="20">
                                        {{ old('content', $post->content) }}
                                    </textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- catgeory -->
                                <div class="form-group">
                                    <label for="input_post_description" class="font-weight-bold">
                                        Category
                                    </label>
                                    <div class="form-control overflow-auto @error('category') is-invalid @enderror"
                                        style="height: 886px">
                                        <!-- List category -->
                                        @include('posts._category-list', [
                                            'categories' => $categories,
                                            'categoryChecked' => old(
                                                'category',
                                                $post->categories->pluck('id')->toArray()),
                                        ])
                                        <!-- End List category -->
                                    </div>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- tag -->
                                <div class="form-group">
                                    <label for="select_post_tag" class="font-weight-bold">
                                        Tag
                                    </label>
                                    <select id="select_post_tag" name="tag[]" data-placeholder="masukkan tag"
                                        class="custom-select w-100 @error('tag') is-invalid @enderror" multiple>
                                        @if (old('tag', $post->tags))
                                            @foreach (old('tag', $post->tags) as $tag)
                                                <option value="{{ $tag->id }}" selected>{{ $tag->title }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('tag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- status -->
                                <div class="form-group">
                                    <label for="select_post_status" class="font-weight-bold">
                                        Status
                                    </label>
                                    <select id="select_post_status" name="status"
                                        class="custom-select @error('status') is-invalid @enderror">
                                        @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('status', $post->status) == $key ? 'selected' : null }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- date picker --}}
                                <div class="form-group">
                                    <label for="post_date" class="font-weight-bold">
                                        Tanggal Post
                                    </label>
                                    <div class='input-group date' id='post_date'>
                                        <input type="datetime-local" name="date" value="{{ old('date', $post->date) }}"
                                            class="form-control @error('date') is-invalid @enderror" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-right">
                                    <a class="btn btn-warning px-4" href="{{ route('posts.index') }}">Back</a>
                                    <button type="submit" class="btn btn-primary px-4">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('css-external')
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endpush


@push('javascript-external')
    {{-- file manager button  --}}
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    {{-- TinyMCE5 --}}
    <script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
@endpush

@push('javascript-internal')
    <script>
        $(document).ready(function() {
            // event : input slug
            $("#input_post_title").change(function(event) {
                $("#input_post_slug").val(
                    event.target.value
                    .trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, "-")
                    .replace(/-+/g, "-")
                    .replace(/^-|-$/g, "")
                );
            });

            // Event : input thumbnail
            $('#button_post_thumbnail').filemanager('image');

            // Text editor content TinyMCE5
            $("#input_post_content").tinymce({
                relative_urls: false,
                language: "en",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table directionality",
                    "emoticons template paste textpattern",
                ],
                toolbar1: "fullscreen preview",
                toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                file_picker_callback: function(callback, value, meta) {
                    let x = window.innerWidth || document.documentElement.clientWidth || document
                        .getElementsByTagName('body')[0].clientWidth;
                    let y = window.innerHeight || document.documentElement.clientHeight || document
                        .getElementsByTagName('body')[0].clientHeight;

                    let cmsURL = "{{ route('unisharp.lfm.show') }}" + '?editor=' + meta.fieldname;
                    if (meta.filetype == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.openUrl({
                        url: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no",
                        onMessage: (api, message) => {
                            callback(message.content);
                        }
                    });
                }
            });

            // select2 : tag post
            //select2 tag
            $('#select_post_tag').select2({
                theme: 'bootstrap4',
                language: "",
                allowClear: true,
                ajax: {
                    url: "{{ route('tags.select') }}",
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

        });
    </script>
@endpush
