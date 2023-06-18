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
                        {{ trans('teachers.add_teacher') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('teachers.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('teachers.edit_teacher') }}</li>
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

                    <form action="{{ route('teachers.update', 'test') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row my-3">
                            <div class="col">
                                <label for="email">{{trans('teachers.email')}}</label>
                                <input id="email" type="email" name="Email"  class="form-control" value="{{ $teacher->Email }}">
                                <input type="hidden" value="{{$teacher->id}}" name="id">
                                @error('Email')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="password">{{trans('teachers.password')}}</label>
                                <input id="password" type="password" name="Password" class="form-control" value="{{ $teacher->Password }}">
                                @error('Password')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="teacher_name">{{trans('teachers.name_ar')}}</label>
                                <input id="teacher_name" type="text" name="Name_ar" class="form-control" value="{{ $teacher->getTranslation('Name', 'ar') }}">
                                @error('teacher_name')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="teacher_name_en">{{trans('teachers.name_en')}}</label>
                                <input id="teacher_name_en" type="text" name="Name_en" class="form-control" value="{{ $teacher->getTranslation('Name', 'en') }}">
                                @error('teacher_name_en')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="specialization">{{ trans('teachers.specialization') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                                    @foreach($specializations as $specialization)
                                        <option value="{{$specialization->id}}" {{ ($specialization->id == $teacher->Specialization_id) ? 'selected' : "" }}>{{$specialization->Name}}</option>
                                    @endforeach
                                </select>
                                @error('specialization')
                                    <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>{{trans('teachers.gender')}}</label>
                                <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                    <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($genders as $gender)
                                        <option value="{{$gender->id}}" {{ ($gender->id == $teacher->Gender_id) ? 'selected' : "" }}>{{$gender->Name}}</option>
                                    @endforeach
                                </select>
                                @error('Blood_Type_Father_id')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="flatpickr">Joining Date</label>
                                <input type="text" class="js-flatpickr form-control bg-white" id="flatpickr" name="Joining_Date" value="{{ $teacher->Joining_Date }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="teacher_address">{{trans('teachers.address')}}</label>
                            <textarea class="form-control" name="Address" id="teacher_address" rows="4">{{ $teacher->Address }}</textarea>
                            @error('teacher_address')
                                <div class="alert alert-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-check fa-fw mr-1"></i>{{ trans('grades.update') }}</button>
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
@endsection
