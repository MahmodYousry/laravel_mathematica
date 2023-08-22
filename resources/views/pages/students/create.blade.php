@extends('layouts.master')

@section('css_adds')
    <link rel="stylesheet" href="{{ asset('dashboard/assets/js/plugins/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.add_student') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('students.index') }}">{{ trans('main_trans.students') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('main_trans.add_student') }}</li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
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

                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h2 class="content-heading mb-4 p-0">{{ trans('students.personal_information') }}</h2>
                        <div class="form-row my-3">
                            <div class="col">
                                <label for="name_ar">{{trans('students.name_ar')}}</label>
                                <input id="name_ar" type="text" name="name_ar" class="form-control">
                                @error('name_ar')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="name_en">{{trans('students.name_en')}}</label>
                                <input id="name_en" type="text" name="name_en" class="form-control">
                                @error('name_en')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col">
                                <label for="email">{{trans('teachers.email')}}</label>
                                <input id="email" type="email" name="email"  class="form-control">
                                @error('Email')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="password">{{trans('teachers.password')}}</label>
                                <input id="password" type="password" name="password" class="form-control">
                                @error('Password')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-3 mb-3">
                                <label>{{trans('teachers.gender')}}</label>
                                <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                    <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3  mb-3">
                                <label>{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="nationality_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($nationalities as $nationality)
                                        <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3  mb-3">
                                <label>{{ trans('students.blood_type') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="blood_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($blood_type as $blood)
                                        <option value="{{$blood->id}}">{{$blood->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3">
                                <label for="birth_date">{{ trans('students.date_of_birth') }}</label>
                                <input id="birth_date" type="text" class="js-flatpickr form-control bg-white"
                                name="birth_date" placeholder="Y-m-d">
                            </div>
                        </div>

                        <h2 class="content-heading mb-4">{{ trans('students.student_information') }}</h2>

                        <div class="form-row my-3">
                            <div class="col-xl-2 mb-3">
                                <label>{{ trans('students.grade') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-2 mb-3">
                                <label>{{ trans('students.classrooms') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="classroom_id">

                                </select>
                            </div>
                            <div class="col-xl-2 mb-3">
                                <label>{{ trans('students.section') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="section_id">

                                </select>
                            </div>

                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('main_trans.Parents') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="parent_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($parents as $parent)
                                        <option value="{{$parent->id}}">{{$parent->Name_Father}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 mb-3">
                                <label>{{ trans('students.academic_year') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="academic_year">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="col-xl-6 offset-xl-3">
                                <div class="form-group">
                                    <label>{{ trans('students.attachments') }}</label>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <!-- When multiple files are selected, we use the word 'Files'. You can easily change it to your own language by adding the following to the input, eg for DE: data-lang-files="Dateien" -->
                                        <input type="file" class="custom-file-input" accept="image/*" data-toggle="custom-file-input" id="student_attachments" name="photos[]" multiple>
                                        <label class="custom-file-label" for="student_attachments">{{ trans('students.choose_file') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-check fa-fw mr-1"></i>{{ trans('students.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty();
                            $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
