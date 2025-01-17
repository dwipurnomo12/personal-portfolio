@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5><b>Home Section</b></h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="/admin/home-section/{{ $homeSection->id }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="hero_image" class="form-label">Hero Image <span
                                        style="color: red">*</span></label><br>
                                <img src="{{ asset('storage/' . $homeSection->hero_image) }}"
                                    class="img-preview img-fluid mb-3 mt-2" id="preview"
                                    style="border-radius: 5px; max-height:300px; max-width:300px; overflow:hidden; display:block;">
                                <input type="file" class="form-control" name="hero_image" id="hero_image"
                                    onchange="previewImage()">
                                @error('hero_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="title" value="{{ $homeSection->title }}">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description <span
                                        style="color: red">*</span></label>
                                <textarea name="short_description" id="summernote" cols="30" rows="10">{{ $homeSection->short_description }}</textarea>
                                @error('short_description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Image -->
    <script>
        function previewImage() {
            preview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <!-- Summernote -->
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ]
            });
        });
    </script>
@endsection
