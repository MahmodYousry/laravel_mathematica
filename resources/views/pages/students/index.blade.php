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
            <div class="block block-rounded">
                <div class="block-content">
                    <a href="{{ route('students.create') }}" class="btn btn-success mr-1 mb-3">
                        <i class="fa fa-fw fa-plus mr-1"></i> {{ trans('main_trans.add_student') }}
                    </a>

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
                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table id="datatable" class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;">ID</th>

                                @if (App::getLocale() == 'en')
                                    <th>{{ trans('students.name_en') }}</th>
                                @else
                                    <th>{{ trans('students.name_ar') }}</th>
                                @endif

                                <th>{{ trans('students.email') }}</th>
                                <th>{{ trans('students.gender') }}</th>
                                <th>{{ trans('students.grade') }}</th>
                                <th>{{ trans('students.classrooms') }}</th>
                                <th>{{ trans('students.section') }}</th>

                                <th style="width: 15%;">{{ trans('grades.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($students as $student)
                                <tr>
                                    <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                                    <td class="font-w600 font-size-sm"><a href="#">{{$student->name}}</a></td>
                                    {{-- <td>{{$student->genders->Name}}</td> --}}
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->gender->Name }}</td>
                                    <td>{{ $student->grade->name }}</td>
                                    <td>{{ $student->classroom->class_name }}</td>
                                    <td>{{ $student->section->section_name }}</td>
                                    <td>
                                        <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">

                                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary m-1">
                                                <i class="fa fa-fw fa-edit mr-1"></i>{{ trans('grades.edit') }}
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger m-1" data-toggle="modal"
                                                        data-target="#modal-delete-student{{$student->id}}">
                                                <i class="fa fa-fw fa-times mr-1"></i>{{ trans('grades.delete') }}
                                            </button>
                                        </div>
                                    </td>

                                    <!-- start delete modal Content -->
                                    <div class="modal fade" id="modal-delete-student{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('teachers.delete_teacher') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center">
                                                                        <p>{{ trans('grades.before_delete_alert') }}</p>
                                                                        <p><strong>{{$student->name}}</strong></p>
                                                                    </div>
                                                                </div>
                                                                <div class="block-content text-center border-top">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-md btn-danger">
                                                                            <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.yes') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.no') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        {{-- End form --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END delete modal Content -->

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- END Dynamic Table Full -->

                </div>
            </div>
        </div>
        <!-- END Page Content -->
    </main>
@endsection
