@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5><b>About Section</b></h5>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="/admin/about-section/{{ $aboutSection->id }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="mb-3">
                                <label for="about_image" class="form-label">Image <span
                                        style="color: red">*</span></label><br>
                                <img src="{{ asset('storage/' . $aboutSection->about_image) }}"
                                    class="img-preview img-fluid mb-3 mt-2" id="preview"
                                    style="border-radius: 5px; max-height:300px; max-width:300px; overflow:hidden; display:block;">
                                <input type="file" class="form-control" name="about_image" id="about_image"
                                    onchange="previewImage()">
                                @error('about_image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">File CV <span style="color: red">*</span></label>
                                @if ($aboutSection->cv)
                                    <div class="mb-2">
                                        <a href="{{ asset('storage/' . $aboutSection->cv) }}" target="_blank"
                                            class="btn btn-info btn-sm">Lihat CV Lama</a>
                                    </div>
                                @endif
                                <input type="file" class="form-control" name="cv" value="{{ $aboutSection->cv }}">
                                @error('cv')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description <span
                                        style="color: red">*</span></label>
                                <textarea name="description" id="summernote" cols="30" rows="10">{{ $aboutSection->description }}</textarea>
                                @error('description')
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
