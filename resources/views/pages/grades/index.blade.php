@extends('layouts.master')

@section('content')
<!-- Main Container -->
<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    {{ trans('grades.grades') }} <small class="font-size-base font-w400 text-muted">{{ trans('grades.table') }}</small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Grades</li>
                        <li class="breadcrumb-item">Grades List</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a class="link-fx" href="">Table</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">

            <div class="block-content block-content-full">
                <!-- start add button -->
                <button type="button" class="btn btn-success mr-1 mb-3" data-toggle="modal" data-target="#modal-add-grade">
                    <i class="fa fa-fw fa-plus mr-1"></i> {{ trans('grades.add_new_grade') }}
                </button>
                <!-- start add modal Content -->
                <div class="modal fade" id="modal-add-grade" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="block block-rounded block-themed block-transparent mb-0">
                                <div class="block-header bg-primary-dark">
                                    <h3 class="block-title">{{ trans('grades.add_new_grade') }}</h3>
                                    <div class="block-options">
                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="block-content font-size-sm">
                                    <form action="{{route('grades.store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-xl-6">
                                                <div class="form-group">
                                                    <label for="name">{{ trans('grades.name_in_arabic') }}</label>
                                                    <input type="text" class="form-control form-control-alt" id="name"
                                                            name="name" placeholder="{{ trans('grades.name_in_arabic') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xl-6">
                                                <div class="form-group">
                                                    <label for="en_name">{{ trans('grades.name_in_english') }}</label>
                                                    <input id="en_name" type="text" class="form-control form-control-alt"
                                                    name="en_name" placeholder="{{ trans('grades.name_in_english') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-xl-12">
                                                <div class="form-group">
                                                    <label for="example-textarea-input-alt">{{ trans('grades.notes') }}</label>
                                                    <textarea class="form-control form-control-alt" id="example-textarea-input-alt"
                                                        name="notes" rows="5" placeholder="{{ trans('grades.optional_field') }}"></textarea>
                                                </div>
                                            </div>
                                            <div class="block-content text-left border-top">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                    <button type="submit" class="btn btn-md btn-primary">
                                                        <i class="fa fa-fw fa-check"></i> {{ trans('grades.save') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END add modal Content -->
                <!-- END add button -->

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
                    <div class="alert alert-success d-flex align-items-center ANIMATED FADEINDOWN" role="alert">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-check"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
                {{-- end errors And Alerts --}}

                <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">ID</th>
                            <th style="width: 30%;">{{ trans('grades.name') }}</th>
                            <th class="d-none d-sm-table-cell">{{ trans('grades.notes') }}</th>
                            <th style="width: 15%;">{{ trans('grades.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr>
                                <td class="text-center font-size-sm">{{$loop->iteration}}</td>
                                <td class="font-w600 font-size-sm">
                                    <a href="#">{{$grade->name}}</a>
                                </td>
                                <td class="d-none d-sm-table-cell font-size-sm">
                                    {{$grade->notes}}
                                </td>
                                <td>
                                    <div class="d-flex flex-xs-column flex-sm-column flex-md-row justify-content-start">
                                        <button type="button" class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#modal-edit-grade{{$grade->id}}">
                                            <i class="fa fa-fw fa-edit mr-1"></i> {{ trans('grades.edit') }}
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger m-1" data-toggle="modal" data-target="#modal-delete{{$grade->id}}">
                                            <i class="fa fa-fw fa-times mr-1"></i> {{ trans('grades.delete') }}
                                        </button>
                                    </div>
                                </td>
                                <!-- start delete modal Content -->
                                <div class="modal fade" id="modal-delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-themed block-transparent mb-0">
                                                <div class="block-header bg-primary-dark">
                                                    <h3 class="block-title">Delete Grade</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content font-size-sm">
                                                    {{-- start form --}}
                                                    <form action="{{route('grades.destroy', $grade)}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="row">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="form-group text-center">
                                                                    {{-- <p>Are You Sure You Want To Delete "<strong>{{$grade->name}}</strong>"  ?</p> --}}
                                                                    <p>{{ trans('grades.before_delete_alert') }} </p>
                                                                    <p><strong>{{$grade->name}}</strong></p>
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

                                <!-- edit modal Content -->
                                <div class="modal fade" id="modal-edit-grade{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-large" aria-hidden="true">
                                    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="block block-rounded block-themed block-transparent mb-0">
                                                <div class="block-header bg-primary-dark">
                                                    <h3 class="block-title">{{ trans('grades.edit_grade') }}</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content font-size-sm">
                                                    <form action="{{ route('grades.update', $grade) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="ar_grade">{{ trans('grades.name_in_arabic') }}</label>
                                                                    <input id="ar_grade" type="text" class="form-control form-control-alt" value="{{ $grade->getTranslation('name', 'ar') }}"
                                                                            name="name" placeholder="{{ trans('grades.name_in_arabic') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-xl-6">
                                                                <div class="form-group">
                                                                    <label for="ar_grade">{{ trans('grades.name_in_english') }}</label>
                                                                    <input type="text" class="form-control form-control-alt" id="ar_grade" placeholder="{{ trans('grades.name_in_english') }}"
                                                                            name="name_en" value="{{ $grade->getTranslation('name', 'en') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="form-group">
                                                                    <label for="notes">{{ trans('grades.notes') }}</label>
                                                                    <textarea class="form-control form-control-alt" id="notes"
                                                                        name="notes" rows="5">{{$grade->notes}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="block-content text-left border-top">
                                                                <div class="form-group">
                                                                    <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">{{ trans('grades.cancel') }}</button>
                                                                    <button type="submit" class="btn btn-md btn-primary">
                                                                        <i class="fa fa-fw fa-check"></i> {{ trans('grades.update') }}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END edit modal Content -->

                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <!-- END Dynamic Table Full -->
            </div>

        </div>
    </div>

</main>
@endsection
