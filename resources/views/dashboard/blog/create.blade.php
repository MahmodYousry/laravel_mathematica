@extends('layouts.master')

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
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content content-boxed">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ trans('blog.new_post') }}</h3>
                </div>
                <div class="block-content">
                    <form action="{{ route('blog.store') }}" method="POST">
                        @csrf
                        <div class="col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label for="title">{{ trans('blog.title') }}</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Post Title">
                            </div>
                            {{-- <div class="form-group">
                                <label>{{ trans('blog.blog_image') }}</label>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <input type="file" class="custom-file-input" data-toggle="custom-file-input"
                                            id="blogImage" name="blogImage">
                                    <label class="custom-file-label" for="blogImage">{{ trans('blog.choose_image') }}</label>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label for="content">{{ trans('blog.content') }}</label>
                                <textarea class="form-control js-summernote" id="content" name="content" rows="4" placeholder="{{ trans('blog.writen') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-check p-1"></i> {{ trans('blog.save') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
<!-- END Main Container -->
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/assets/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/plugins/simplemde/simplemde.min.js') }}"></script>
@endsection
