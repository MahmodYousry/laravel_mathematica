@extends('layouts.master')

@section('content')
    <!-- Main Container -->
    <main id="main-container">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                    <h1 class="flex-sm-fill h3 my-2">
                        {{ trans('main_trans.students_manage_promotion') }}
                    </h1>
                    <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-alt">
                            <li class="breadcrumb-item" aria-current="page">
                                <a class="link-fx" href="{{ route('home') }}">{{ trans('main_trans.Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">{{ trans('main_trans.students_manage_promotion') }}</li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        @if (App::getLocale() == 'en')
            <?php $textRight = ''; ?>
            <?php $dir = ''; ?>
        @else
            <?php $textRight = 'text-right'; ?>
            <?php $dir = 'dir=rtl'; ?>
        @endif


        <!-- Page Content -->
        <div class="content">
            <div class="block block-rounded">
                <div class="block-content">
                    <button type="button" class="btn btn-danger mb-3 btn-sm text-capitalize" data-toggle="modal" data-target="#resetAll">
                        reset all - تراجع عن الكل
                    </button>
                    <!-- Modal reset -->
                    <div class="modal fade" id="resetAll" tabindex="-1" role="dialog" aria-labelledby="resetAll" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reset all</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-capitalize">are you sure about this ?</p>

                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('promotion.destroy', 'test') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="page_id" value="1">
                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    {{-- errors And Alerts --}}
                    @include('components.errors')

                    <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                    <table {{ $dir }} id="datatable" class="table table-responsive-xl table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                {{-- <th class="text-center" style="width: 60px;">ID</th> --}}

                                @if (App::getLocale() == 'en')
                                    <th class="alert-info">{{ trans('students.name_en') }}</th>
                                @else
                                    <th class="alert-info">{{ trans('students.name_ar') }}</th>
                                @endif

                                <th class="alert-danger">{{ trans('students.old_grade') }}</th>
                                <th class="alert-danger">{{ trans('students.old_classroom') }}</th>
                                <th class="alert-danger">{{ trans('students.old_section') }}</th>
                                <th class="alert-danger">{{ trans('students.academic_year') }}</th>

                                <th class="alert-success">{{ trans('students.current_grade') }}</th>
                                <th class="alert-success">{{ trans('students.current_classroom') }}</th>
                                <th class="alert-success">{{ trans('students.current_section') }}</th>
                                <th class="alert-success">{{ trans('students.current_academic_year') }}</th>

                                <th class="alert-secondary" style="width: 15%;">{{ trans('grades.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($promotions as $promotion)
                                <tr>
                                    {{-- <td class="text-center font-size-sm">{{ $loop->iteration }}</td> --}}
                                    <td class="font-w600 font-size-sm"><a href="#">{{ $promotion->student->name }}</a></td>

                                    <td>{{ $promotion->f_grade->name }}</td>
                                    <td>{{ $promotion->f_classroom->class_name }}</td>
                                    <td>{{ $promotion->f_section->section_name }}</td>
                                    <td>{{ $promotion->academic_year }}</td>

                                    <td>{{ $promotion->t_grade->name }}</td>
                                    <td>{{ $promotion->t_classroom->class_name }}</td>
                                    <td>{{ $promotion->t_section->section_name }}</td>
                                    <td>{{ $promotion->new_academic_year }}</td>
                                    <td>
                                        <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-around aligm-items-sm-between">
                                            <button type="button" class="btn btn-sm btn-outline-danger w-xl-25 mr-2"
                                                data-toggle="modal"
                                                data-target="#delete-this{{ $promotion->id }}">
                                                ارجاع الطالب
                                            </button>

                                            <button type="button" class="btn btn-sm btn-outline-success w-xl-25"
                                                data-toggle="modal"
                                                data-target="#student-graduate{{ $promotion->student_id }}">
                                                تخرج الطالب
                                            </button>
                                        </div>
                                    </td>

                                    <!-- start delete modal Content -->
                                    <div class="modal fade" id="delete-this{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="block block-rounded block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark">
                                                        <h3 class="block-title">{{ trans('main_trans.confirm') }}</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-fw fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content font-size-sm">
                                                        {{-- start form --}}
                                                        <form action="{{ route('promotion.destroy', $promotion->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <div class="form-group text-center">
                                                                        <p>{{ trans('grades.before_delete_alert') }}</p>
                                                                        {{ $promotion->student->name }}
                                                                        <input type="hidden" name="id" value="{{ $promotion->id }}">
                                                                        <input type="hidden" name="page_id" value="2">
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
