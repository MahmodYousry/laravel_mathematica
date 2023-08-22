@extends('layouts.master')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.students_list') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('main_trans.students_list') }}</li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <h2 class="content-heading">Student Details</h2>
            {{-- errors And Alerts --}}
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <p class="mb-0">{{ $error }}</p>
                    </div>
                @endforeach
            @endif
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center animated fadeInDown" role="alert">
                    <div class="flex-00-auto">
                        <i class="fa fa-fw fa-check"></i>
                    </div>
                    <div class="flex-fill ml-3">
                        <p class="mb-0 text-capitalize">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger d-flex align-items-center animated fadeInDown" role="alert">
                    <div class="flex-00-auto">
                        <i class="far fa-sad-tear fa-fw"></i>
                    </div>
                    <div class="flex-fill ml-3">
                        <p class="mb-0 text-capitalize">{{ session('error') }}</p>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif
            {{-- end errors And Alerts --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">General <small>Information</small></h3>
                        </div>
                        <div class="block-content">
                            <p>ID : {{ $studentInfo->id }}</p>
                            <p>Name : {{ $studentInfo->name }}</p>
                            <p>Email : {{ $studentInfo->name }}</p>
                            <p>Gender : {{ $studentInfo->gender->Name }}</p>
                            <p>Nationality : {{ $studentInfo->nationality->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Personal <small>Information</small></h3>
                        </div>
                        <div class="block-content">
                            <p>Blood Type : {{ $studentInfo->blood->name }}</p>
                            <p>Birth date : {{ $studentInfo->birth_date }}</p>
                            <p>Grade : {{ $studentInfo->grade->name }}</p>
                            <p>Classroom : {{ $studentInfo->classroom->class_name }}</p>
                            <p>Section  : {{ $studentInfo->section->section_name }}</p>
                            <p>Parent  : {{ $studentInfo->myparent->Name_Father }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="content-heading">Student Attachments</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="block">
                        {{-- Attachments add Form --}}
                        <form action="{{ route('upload_attachments') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="p-3">
                                <label>{{ trans('students.attachments') }}</label>
                                <div class="custom-file">
                                    <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                    <!-- When multiple files are selected, we use the word 'Files'. You can easily change it to your own language by adding the following to the input, eg for DE: data-lang-files="Dateien" -->
                                    <input type="file" class="custom-file-input" accept="image/*"
                                        data-toggle="custom-file-input" id="student_attachments" name="photos[]" multiple>
                                    <label class="custom-file-label" for="student_attachments">{{ trans('students.choose_file') }}</label>

                                    <input type="hidden" name="student_name" value="{{ $studentInfo->name }}">
                                    <input type="hidden" name="student_id" value="{{ $studentInfo->id }}">
                                </div>
                            </div>

                            <div class="d-block pb-3 pl-3">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-check fa-fw mr-1"></i>{{ trans('grades.save') }}</button>
                            </div>
                        </form>
                    </div>
                    {{-- End Attachments Form --}}
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Attachments <small>Information</small></h3>
                        </div>
                        <div class="block-content">
                            @if($studentInfo->images->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th style="width: 100px;" class="text-center">ID</th>
                                            <th class="text-center">{{trans('students.file_name')}}</th>
                                            <th class="text-center">{{trans('students.created_at')}}</th>

                                            <th class="text-center" style="width: 100px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($studentInfo->images as $attachment)
                                            <tr>
                                                <td class="font-w600 font-size-sm text-center">{{ $loop->iteration }}</td>
                                                <td class="font-size-sm">{{ $attachment->filename }}</td>
                                                <td class="font-size-sm">{{ $attachment->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-alt-primary d-flex align-items-center"
                                                            href="{{url('download_attachments')}}/{{ $attachment->imageable->name }}/{{ $attachment->filename }}">
                                                            <i class="fas fa-download mr-2"></i> {{ trans('students.download') }}
                                                        </a>
                                                        <button type="button"
                                                                class="btn btn-sm btn-alt-danger d-flex align-items-center"
                                                                data-toggle="modal" data-target="#modal-delete-attachment{{ $attachment->id }}" >

                                                            <i class="fa fa-fw fa-times mr-2"></i> {{ trans('students.delete') }}
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- delete Attachments Modal -->
                                            <div class="modal fade" id="modal-delete-attachment{{ $attachment->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                                <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="block block-rounded block-themed block-transparent mb-0">
                                                            <div class="block-header bg-primary-dark">
                                                                <h3 class="block-title">{{ trans('students.sure') }}</h3>
                                                                <div class="block-options">
                                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                        <i class="fa fa-fw fa-times"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="block-content font-size-sm">
                                                                <form action="{{ route('delete_attachment') }}" method="POST">
                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <p class="text-center">Are You Sure You Want To Delete This Attachment ?</p>
                                                                        <input type="hidden" name="id" value="{{ $attachment->id }}">
                                                                        <input type="hidden" name="student_name" value="{{ $attachment->imageable->name }}">
                                                                        <input type="hidden" name="student_id" value="{{ $attachment->imageable->id }}">
                                                                        <input class="form-control" type="text" name="filename" readonly value="{{ $attachment->filename }}">
                                                                    </div>
                                                                    <div class="pt-3 border-top">
                                                                        <div class="form-group">
                                                                            <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                                            <button type="submit" class="btn btn-md btn-primary">
                                                                                <i class="fa fa-fw fa-check"></i> {{ trans('grades.yes') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete Attachments END -->
                                        @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @else
                            <div class="alert alert-info">There Is no Attachments For This Student</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <!-- END Page Content -->
    </main>
@endsection
