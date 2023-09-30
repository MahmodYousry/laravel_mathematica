@extends('layouts.master')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.stud_graduated_list') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('main_trans.stud_graduated_list') }}</li>
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
                    @include('components.errors')

                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table id="datatable" class="table table-responsive-xl table-bordered table-striped table-vcenter js-dataTable-full">
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
                                <th>{{ trans('students.current_academic_year') }}</th>

                                <th>{{ trans('grades.action') }}</th>
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
                                    <td>{{ $student->academic_year }}</td>
                                    <td>
                                        <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-around aligm-items-sm-between">
                                            <button type="button" class="btn btn-sm btn-success w-xl-25 mr-2"
                                                data-toggle="modal"
                                                data-target="#return-student{{ $student->id }}">
                                                {{ trans('main_trans.return_student') }}
                                            </button>

                                            <button type="button" class="btn btn-sm btn-danger w-xl-25"
                                                data-toggle="modal"
                                                data-target="#delete-student{{ $student->id }}">
                                                {{ trans('main_trans.delete_student') }}
                                            </button>
                                        </div>
                                    </td>

                                    <!-- start return Student Modal -->
                                    <div class="modal fade" id="return-student{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('main_trans.return_student') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('graduate.update', 'test') }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center">
                                                                        <p>{{ trans('action.return_student_confirm') }}</p>
                                                                        <p><strong>{{$student->name}}</strong></p>
                                                                        <input type="hidden" name="id" value="{{ $student->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="block-content text-center border-top">
                                                                    <div class="form-group">
                                                                        <button type="submit" class="btn btn-md btn-success">
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
                                    <!-- END return Student Modal -->

                                    <!-- start return Student Modal -->
                                    <div class="modal fade" id="delete-student{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('main_trans.delete_student') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('graduate.destroy', $student->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center">
                                                                        <p>{{ trans('action.confirm_delete_student') }}</p>
                                                                        <p><strong>{{ $student->name }}</strong></p>
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
                                    <!-- END return Student Modal -->

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
