@extends('layouts.master')

@section('css_adds')
  <style>
    .img-thumb {
      width: auto;
      height: auto;
      max-height: 600px;
      box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
      border-radius: 6px;
    }

    .img-thumb img {
      max-height: 600px;
    }
  </style>
@endsection

@section('content')
<!-- Main Container -->
<main id="main-container">
  <!-- Hero -->
  <div class="bg-body-light">
    <div class="content content-full">
      <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
        <h1 class="flex-sm-fill h3 my-2">
          {{ trans('blog.blog') }} <small class="font-size-base font-w400 text-muted">{{ trans('blog.posts') }}</small>
        </h1>
        <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-alt">
            <li class="breadcrumb-item">{{ trans('blog.blog') }}</li>
            <li class="breadcrumb-item" aria-current="page">
              <a class="link-fx" href="">{{ trans('blog.posts') }}</a>
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <!-- Page Content -->
  <div class="content content-boxed">
    <div class="block block-rounded mb-0">
      <div class="block block-content mb-0">
        <a class="btn btn-success mb-3" href="{{ route('blog.index') }}"><i class="fa fa-arrow-left mr-2"></i>Back</a>
      </div>
    </div>
  </div>
  <div class="content content-boxed pt-3">
    <div class="block block-rounded">
      <div class="block-header block-header-default">
        <h3 class="block-title">{{ trans('blog.new_post') }}</h3>
      </div>
      <div class="block-content">
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="col-lg-12 col-xl-12">
            {{-- title --}}
            <div class="form-group">
              <label for="title">{{ trans('blog.title') }}</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Post Title" value="{{ old('title') }}">
            </div>

            {{-- blog image --}}
            <div class="form-group">
              <label>{{ trans('blog.blog_image') }}</label>
              <div class="custom-file">
                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                <input type="file" class="custom-file-input" data-toggle="custom-file-input" id="thumbnail" name="thumbnail" accept="image/*">
                <label class="custom-file-label" for="thumbnail">{{ trans('blog.choose_image') }}</label>
              </div>
            </div>

            {{-- thumbnail preview --}}
            <div class="form-group">
              <label>{{ trans('main_trans.post_img_prev') }}</label>
              <div class="img-thumb">
                <img id="post_image_preview" class="d-block mx-auto" src="{{ url('storage/no-image.png') }}" alt="post preview">
              </div>
            </div>

            {{-- content --}}
            <div class="form-group">
              <label for="content">{{ trans('blog.content') }}</label>
              <textarea class="form-control js-summernote" id="content" name="content" rows="4" placeholder="{{ trans('blog.writen') }}">{{ old('title') }}</textarea>
            </div>

            {{-- submit --}}
            <div class="form-group">
              <button class="btn btn-primary" type="submit">
                <i class="fa fa-check p-1"></i>{{ trans('blog.save') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<!-- END Main Container -->
@endsection

@section('scripts')
  <script src="{{ asset('dashboard/assets/js/plugins/summernote/summernote-bs4.min.js') }}"></script>

  <script>
    // this script is responsible for previwing the image after user select it
    // Select the file input and the image preview element
    const imageInput = document.getElementById('thumbnail');
    const preview = document.getElementById('post_image_preview');

    // Add an event listener to handle when a file is selected
    imageInput.addEventListener('change', function () {
      // Check if a file is selected
      if (this.files && this.files[0]) {
        // Create a new FileReader instance
        const reader = new FileReader();

        // Define the onload function that will execute once the file is read
        reader.onload = function (e) {
          // Set the src of the image preview element to the file data
          preview.src = e.target.result;
          // Display the image element
          preview.style.display = 'block';
        };

        // Read the file as a data URL (base64 encoded string)
        reader.readAsDataURL(this.files[0]);
      } else {
        // If no file is selected, hide the image preview
        preview.style.display = 'none';
        preview.src = ''; // Clear the src attribute
      }
    });
  </script>
@endsection
